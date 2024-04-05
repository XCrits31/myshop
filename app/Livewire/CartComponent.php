<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
class CartComponent extends Component
{

    public function qtyup($rowid)
    {
        $product = Cart::get($rowid);
        Cart::update($rowid,$product->qty+1);
    }
    public function qtydown($rowid)
    {
        $product = Cart::get($rowid);
        Cart::update($rowid,$product->qty-1);
    }
    public function render()
    {
        return view('livewire.cart-component')->with([
            'all' => Category::all()
        ]);
    }
}
