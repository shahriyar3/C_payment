<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentRequest;
use App\Models\Payment;
use App\Services\PaymentAuthenticationService;
use App\Services\PaymentCreateService;
use Illuminate\Http\Request;

class StorePaymentController extends Controller
{
    public function store(StorePaymentRequest $request)
    {
        $payment = Payment::query()->where('payment_id', '=', $request->payment_id)->firstOrFail();
        $payment->update(['amount' => $request->amount]);

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
}
