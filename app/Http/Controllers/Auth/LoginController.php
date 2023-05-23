<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\StoreLoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(StoreLoginRequest $request)
    {
        $user = User::query()->where('username', '=', $request->username)->firstOrFail();
        if (!Hash::check($request->password, $user->password)) {
            return redirect()->route('login')->with('error', __('message.login failed'));
        }
        auth()->login($user);
        return redirect()->route('upcadmin.dashboard');
    }
}
