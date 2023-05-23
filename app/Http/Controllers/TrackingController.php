<?php

namespace App\Http\Controllers;

use App\Http\Requests\TrackPaymentRequest;
use App\Models\Payment;
use Illuminate\Support\Facades\Log;

class TrackingController extends Controller
{
    public function track(TrackPaymentRequest $request)
    {
        $payment = Payment::query()->where('payment_id', '=', $request->payment_id)->first();
        if ($payment and $payment->status == 'success') {
            return response()->json([
                'result' => 'success',
                'amount' => $payment->amount,
                'currency' => config('payment.currency'),
                'status' => 'approved',
                'payment_id' => $request->payment_id,
                'checksum' => $this->make_hash($payment),
            ]);
        }

        return response()->json([
            'result' => 'error',
            'error_code' => 'INTERNAL_ERROR',
            'error_description' => 'Other payment system error',
            'amount' => $payment->amount,
            'currency' => config('payment.currency'),
            'status' => 'failed',
            'payment_id' => $request->payment_id,
            'checksum' => $this->make_hash($payment),
        ]);

    }

    private function make_hash($payment)
    {
        $keys = "success|{$payment->payment_id}|{$payment->amount}|" . config("payment.currency") . "|approved";
        $hash = hash_hmac('sha256', $keys, config('payment.ps_secret'));

        return $hash;
    }
}
