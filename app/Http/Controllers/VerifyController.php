<?php

namespace App\Http\Controllers;

use App\Models\Payment;
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
            Log::alert('1111111111111111111111111');
            return redirect()->route('alert', ['text' => 'gateway_error']);
        }

        $token = app(PaymentAuthenticationService::class)->handle();
        if (!$token) {
            $payment->update([
                'status' => 'failed'
            ]);
            Log::alert('1111111111111111111111111');
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
}
