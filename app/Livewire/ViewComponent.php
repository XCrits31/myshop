<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;
use Cart;

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
            'products' => $this->products
        ]);
    }
    public function store($product_id, $product_name, $product_price, $user_id) : void
    {
        Cart::add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
        Cart::store($user_id);
        session()->flash('success', 'Added to Cart');
        $this->redirectRoute('cart');
    }

}
