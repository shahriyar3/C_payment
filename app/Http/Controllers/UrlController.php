<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UrlController extends Controller
{
    public function show()
    {
        return response()->json([
            'status' => 'ok',
            'message' => 'success'
        ]);
    }
}
