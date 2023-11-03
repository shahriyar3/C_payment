<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateActivePaymentRequest;
use App\Models\Setting;
use Illuminate\Http\Request;

class ActivePaymentController extends Controller
{
    public function index()
    {
        $active_payment = Setting::query()->where('name', '=', 'active_payment')->first()->value;
        return view('admin.payment.change_active_payment', compact('active_payment'));
    }

    public function store(UpdateActivePaymentRequest $request)
    {
        Setting::query()->where('name', '=', 'active_payment')->update(['value' => $request->active_payment]);
        return redirect()->back()->withErrors('success', 'success');
    }
}
