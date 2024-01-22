<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentRequest;
use App\Models\Payment;
use App\Models\Setting;
use App\Services\PaymentAuthenticationService;
use App\Services\PaymentCreateService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class StorePaymentController extends Controller
{
    public function store(StorePaymentRequest $request)
    {
        $payment = Payment::query()->where('payment_id', '=', $request->payment_id)->firstOrFail();
        $payment->update(['amount' => $request->amount]);

        $active_payment = Setting::query()->where('name', '=', 'active_payment')->value('value');
        $active_payment = \App\Enum\Payment::VODAPAY->value;
        return match ($active_payment) {
            \App\Enum\Payment::KENZO->value => $this->kenzo($payment),
            \App\Enum\Payment::IRGATE->value => $this->irgate($payment),
            \App\Enum\Payment::VODAPAY->value => $this->voda($payment),
        };

    }

    private function kenzo($payment)
    {
        $token = app(PaymentAuthenticationService::class)->handle();
        if (!$token)
            return redirect()->route('alert', ['text' => 'gateway_error']);

        $response = app(PaymentCreateService::class)->handle($payment, $token);
        if (!$response)
            return redirect()->route('alert', ['text' => 'gateway_error']);

        $payment->update([
            'transaction_id' => $response->id
        ]);

        return redirect()->to($response->payment_url);
    }

    private function irgate($payment)
    {
        $base_url = config('irgate.base_url');
        $result = Http::asForm()->post($base_url . 'api/deposit', [
            "api_key" => config('irgate.irgate_token'),
            "redirect_url" => config('app.url') . "payment/gateway-callback?callback=true&language=fa&token=" . $payment->payment_id,
            "result_url" => config('app.url') . "api/gateway-tracking?callback=result&language=fa",
            "amount" => $payment->amount,
            "payment_currency" => 'IRT',
            "return_currency" => 'IRT',
            "mobile" => "09123456789",
            "email" => "$payment->user_name",
            "description" => $payment->user_id,
            "datetime" => time(),
            "order_id" => (int)$payment->payment_id
        ]);

        $result = json_decode($result->body());
        if ($result?->code == 1) {
            $payment->update([
                'secret' => $result?->secret
            ]);
            return redirect($result->msg);
        }
        abort(404);
    }

    private function voda($payment)
    {
        $json = json_encode([
            "Amount" => 100000,
            "currency" => "TOM",
            "customData1" => "customData1",
            "customData2" => "customData2",
            "callBackUrl" => "your callBackUrl",
            "cancelUrl" => "your cancelUr",
            "directNotifyUrl" => "your directNotifyUrl",
        ]);

        $string = md5($json . config('vodapay.privatekey'));

        $base_url = config('vodapay.base_url');
        $result = Http::asForm()->post($base_url, [
            'authKey' => config('vodapay.authKey'),
            'privateKey' => config('vodapay.privatekey'),
            "Amount" => (int)$payment->amount,
            "currency" => "TOM",
            "customData1" => $payment->payment_id,
            "customData2" => $payment->user_id,
            "callBackUrl" => config('vodapay.callback_url'),
            "cancelUrl" => config('cancel_url'),
            "directNotifyUrl" => config('vodapay.callback_url'),
        ]);
        dd($result->body());
        $result = json_decode($result->body());
        if ($result?->code == 1) {
            $payment->update([
                'secret' => $result?->secret
            ]);
            return redirect($result->msg);
        }
        abort(404);
    }
}
