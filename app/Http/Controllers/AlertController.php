<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AlertController extends Controller
{
    public function show(string $text, string|null $token = null)
    {
        if ($text == 'success')
            return view('alert_success')->with('token', $token)->with('success', trans($text));

        return view('alert_error')->with('token', $token)->with('error', trans($text));
    }
}
