<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class ViewComponent extends Component
{
    public $category;
    public $products;
    public $all;

    public function mount($id)
    {
        $this->category = Category::findOrFail($id);
        $this->products = Category::with('products')->findOrFail($id)->products;
        $this->all = Category::all();
    }

    public function render()
    {
        return view('livewire.view-component', [
            'category' => $this->category,
            'products' => $this->products,
            'all' => $this->all
        ]);
    }
    public function store($product_id, $product_name, $product_price)
    {
        Cart::add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
        request()->session()->flash('success', 'Added Successfully');
    }

}
