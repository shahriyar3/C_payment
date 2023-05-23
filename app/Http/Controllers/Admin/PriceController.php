<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Price;
use Illuminate\Http\Request;

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

    public function store( $request)
    {

    }

    public function show(string $id)
    {
        //
    }

   public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
