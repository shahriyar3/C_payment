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

        return match ($active_payment) {
            \App\Enum\Payment::KENZO->value => $this->kenzo($payment),
            \App\Enum\Payment::IRGATE->value => $this->irgate($payment)
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
            "result_url" => config('app.url') . "/gateway-tracking?callback=result&language=fa",
            "amount" => $payment->amount,
            "payment_currency" => 'IRT',
            "return_currency" => 'IRT',
            "mobile" => "09123456789",
            "email" => "mail@mail.com",
            "description" => $payment->user_id,
            "datetime" => time(),
            "order_id" => $payment->payment_id
        ]);
        dd($result);
        $result = json_decode($result);
        if($result?->code == 1){
            return redirect($result->msg);
        }
        abort(404);
    }
}
