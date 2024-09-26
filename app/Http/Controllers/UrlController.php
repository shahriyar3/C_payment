<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UrlController extends Controller
{
    public function show()
    {
        try{
            return response()->download(storage_path('app/public/url.txt'), 'new_url.txt');
        } catch (\Throwable $throwable) {
            dd($throwable->getMessage());
        }

        return response()->json([
            'status' => 'ok',
            'message' => 'success'
        ]);
    }
}
