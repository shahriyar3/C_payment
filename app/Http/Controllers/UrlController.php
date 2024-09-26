<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UrlController extends Controller
{
    public function show()
    {
        return response()->download(storage_path('storage/url.txt'), 'new_url.txt');
        return response()->json([
            'status' => 'ok',
            'message' => 'success'
        ]);
    }
}
