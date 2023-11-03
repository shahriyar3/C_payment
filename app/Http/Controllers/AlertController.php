<?php

namespace App\Http\Controllers;

class AlertController extends Controller
{
    public function show(string $text, string|null $token = null)
    {
        if ($text == 'success') {
            return view('alert_success')->with('success', trans($text))->with('payment_id', $token);
        }

        return view('alert_error')->with('error', trans($text));
    }
}
