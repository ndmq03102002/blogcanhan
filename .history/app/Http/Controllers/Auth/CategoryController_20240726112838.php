<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function create()
    {
        $config['seo'] = config('apps.cat');
        $config['method'] = 'create';
        $template = 'user.store';
        return view('dashboard.layout', compact(
            'template',
            'config',
        ));
    }
}
