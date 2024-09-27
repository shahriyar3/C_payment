<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UploadUrlSelectRequest;
use Illuminate\Http\Request;

class UrlSelectController extends Controller
{
    public function index()
    {
        return view('admin.url.index');
    }

    public function upload(UploadUrlSelectRequest $request)
    {
        $request->file('file')->storePubliclyAs('/public', 'url.txt');
        return back()->with(['message' => 'success']);
    }
}
