<?php

// app/Http/Controllers/CKEditorController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CKEditorController extends Controller
{
    public function upload(Request $request)
    {
        $file = $request->file('upload');
        $path = $file->store('public/images');
        $url = Storage::url($path);

        return response()->json([
            'uploaded' => true,
            'url' => $url
        ]);
    }
}
