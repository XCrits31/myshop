<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;
use Gloudemans\Shoppingcart\Cart;
class CartComponent extends Component
{

    public function render()
    {
        return view('livewire.cart-component')->with([
            'all' => Category::all()
        ]);
    }
}
