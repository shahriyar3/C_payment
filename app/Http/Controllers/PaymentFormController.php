<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Price;

class PaymentFormController extends Controller
{
    public function showPaymentForm(string $payment_id)
    {
        $payment = Payment::query()->where('payment_id', '=', $payment_id)->firstOrFail();
        $prices = Price::query()->get();
        return view('payment', compact('payment', 'prices'));
    }
}
