<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Setting;
use App\Services\PaymentDepositListenerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class PaymentController extends Controller
{
    public function getToken(Request $request)
    {
        $values = json_decode(base64_decode(urldecode($request->get('token'))));
        $payment_id = time();
        sleep(1);
        $active_payment = Setting::query()->where('name', '=', 'active_payment')->value('value');
        Payment::query()->create([
            'user_id' => $values->userId,
            'user_name' => $values->userFirstname ?? 'No Name',
            'token' => urldecode($request->get('token')),
            'decrypted_data' => $values,
            'payment_id' => $payment_id,
            'amount' => null,
            'payment_type' => $active_payment
        ]);
        Config::set('payment.return_url', $values?->urlOrigin);
        return redirect()->route('show_payment_form', ['token' => $payment_id]);
    }
}
