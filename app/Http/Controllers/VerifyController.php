<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Setting;
use App\Services\PaymentAuthenticationService;
use App\Services\PaymentDepositListenerService;
use App\Services\PaymentVerifyService;
use Illuminate\Support\Facades\Log;

class VerifyController extends Controller
{
    public function verify()
    {
        $payment = Payment::query()->where('transaction_id', '=', \request('payId'))->first();

        if (!request()->has('status') or request('status') != '1') {
            $payment->update([
                'status' => 'failed'
            ]);

            return redirect()->route('alert', ['text' => 'gateway_error']);
        }

        $token = app(PaymentAuthenticationService::class)->handle();
        if (!$token) {
            $payment->update([
                'status' => 'failed'
            ]);
            return redirect()->route('alert', ['text' => 'gateway_error']);
        }

        $response = app(PaymentVerifyService::class)->handle($token);
        if (!$response) {
            $payment->update([
                'status' => 'failed'
            ]);
            return redirect()->route('alert', ['text' => 'error']);
        }

        $payment->update([
            'status' => strtolower($response->status),
            'result' => (array)$response
        ]);
        $listener = app(PaymentDepositListenerService::class)->handle($payment);
        return redirect()->route('alert', ['text' => strtolower($response->status), 'token' => $payment->payment_id]);
    }

    public function gatewayTracking()
    {
        $payment = Payment::query()
            ->where('transaction_id', '=', \request('token', '123'))
            ->firstOrFail();

        $hash = sha1(sha1($payment->secret . ":" . $payment->order_id . ":" . $payment->transaction_id . ":" . $payment->amount));
        Log::debug(request()->all());
        if($hash == request('hash') and request('code') == 1){
            $payment->update(['status' => 'success', 'result' => request()->all()]);
            app(PaymentDepositListenerService::class)->handle($payment);
        }
    }

    public function irGateVerify()
    {
        $payment = Payment::query()
            ->where('transaction_id', '=', \request('transaction_id'))
            ->firstOrFail();

        $hash = sha1(sha1($payment->secret . ":" . $payment->order_id . ":" . $payment->transaction_id . ":" . $payment->amount));
        if($hash == request('hash') and request('code') == 1){
            $payment->update(['status' => 'success', 'result' => request()->all()]);
            return redirect()->route('alert', ['text' => 'success', 'token' => $payment->payment_id]);
        }

        $payment->update([
            'status' => 'failed',
            'result' => json_encode(request()->all())
        ]);

        return redirect()->route('alert', ['text' => 'gateway_error']);
    }
}
