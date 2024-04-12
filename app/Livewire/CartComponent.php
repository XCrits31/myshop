<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
class CartComponent extends Component
{

    public function qtyup($rowid): void
    {
        $product = Cart::get($rowid);
        Cart::update($rowid,$product->qty+1);
    }
    public function qtydown($rowid): void
    {
        $product = Cart::get($rowid);
        Cart::update($rowid,$product->qty-1);
    }
    public function delete($id): void
    {
        Cart::remove($id);
        request()->session()->flash("session", "Removed successfully");
    }
    public function clear(): void
    {
        Cart::destroy();
    }
    public function render()
    {
        return view('livewire.cart-component');
    }
}
