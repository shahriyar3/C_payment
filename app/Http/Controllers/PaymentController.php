<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Services\PaymentDepositListenerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class PaymentController extends Controller
{
    public function getToken(Request $request)
    {
        $values = json_decode(base64_decode(urldecode($request->get('token'))));
        $payment_id = uniqid(time(), true);
        Payment::query()->create([
            'user_id' => $values->userId,
            'user_name' => $values->userFirstname ?? 'No Name',
            'token' => urldecode($request->get('token')),
            'decrypted_data' => $values,
            'payment_id' => $payment_id,
            'amount' => null,
        ]);
        Config::set('payment.return_url', $values?->urlOrigin);
        return redirect()->route('show_payment_form', ['token' => $payment_id]);
    }
}
