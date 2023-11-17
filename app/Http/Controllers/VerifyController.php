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
            ->where('payment_id', '=', \request('order_id', '123'))
            ->first();

        $hash = sha1(sha1($payment->secret . ":" . $payment->payment_id . ":" . request('transaction_id') . ":" . $payment->amount));
        $log = $hash == request('hash');
        Log::debug($log);
        Log::debug(' ================================= ');
        Log::debug((int)request('code') == 1);
        if($hash == request('hash') and (int)request('code') == 1){
            $payment->update(['status' => 'success', 'result' => request()->all()]);
            app(PaymentDepositListenerService::class)->handle($payment);
        } else {
            $payment->update(['status' => 'failed', 'result' => request()->all()]);
        }
        return true;
    }

    public function irGateVerify()
    {
        $payment = Payment::query()
            ->where('payment_id', '=', \request('token'))
            ->firstOrFail();

        if($payment->status == 'success'){
            return redirect()->route('alert', ['text' => 'success', 'token' => $payment->payment_id]);
        }

        return redirect()->route('alert', ['text' => 'gateway_error']);
    }
}
