<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
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
