<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePriceRequest;
use App\Models\Price;

class PriceController extends Controller
{
    public function index()
    {
        $prices = Price::query()->get();
        return view('admin.prices.index', compact('prices'));
    }

    public function create()
    {
        return view('admin.prices.create');
    }

    public function store(StorePriceRequest $request)
    {
        Price::query()->create($request->validated());
        return redirect()->to(route('upcadmin.prices.index'));
    }

    public function destroy(Price $price)
    {
        $price->delete();
        return redirect()->to(route('upcadmin.prices.index'));

    }

    public function remove(Price $price)
    {
        $price->delete();
        return back();
    }
}
