<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;

class AppContoller extends Controller
{
    public function Viewcontrol($viewid){

        $cat = Category::with('products')->where('id', $viewid)->firstOrFail();

        return view('view', compact('cat'));
    }

    public function show($id)
    {
        return view('view', [
            'category' => Category::findOrFail($id),
            'products' => Category::with('products')->findOrFail($id),
            'all' => Category::all()
        ]);
    }
}
