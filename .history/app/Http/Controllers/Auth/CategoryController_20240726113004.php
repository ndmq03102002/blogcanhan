<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function create()
    {
        $config['seo'] = config('apps.cats');
        $config['method'] = 'create';
        $template = 'cat.store';
        return view('dashboard.layout', compact(
            'template',
            'config',
        ));
    }
}
