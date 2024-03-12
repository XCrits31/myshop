<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;

class AppContoller extends Controller
{

    public function show($id)
    {
        return view('view', [
            'category' => Category::findOrFail($id),
            'products' => Category::with('products')->findOrFail($id),
            'all' => Category::all()
        ]);
    }
    public function nav()
    {
        return view('index', [
            'all' => Category::all()
        ]);
    }
}

