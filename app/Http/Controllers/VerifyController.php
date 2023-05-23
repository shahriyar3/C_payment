<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Services\PaymentAuthenticationService;
use App\Services\PaymentDepositListenerService;
use App\Services\PaymentVerifyService;

class VerifyController extends Controller
{
    public function verify()
    {
        $payment = Payment::query()->where('transaction_id', '=', \request('payId'))->first();

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
            'status' => strtolower($response->status)
        ]);
        $listener = app(PaymentDepositListenerService::class)->handle($payment);
        return redirect()->route('alert', ['text' => strtolower($response->status), 'token' => $payment->transaction_id]);
    }
}
