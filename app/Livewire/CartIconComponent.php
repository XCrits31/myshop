<?php

namespace App\Livewire;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartIconComponent extends Component
{
   public function render()
    {
        return view('livewire.cart-icon-component', [
            'cartItems' => Cart::content(),
            'total' => Cart::total()
        ]);
    }
}
