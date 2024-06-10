<?php

namespace App\Livewire;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartIconComponent extends Component
{
    private $total;
    private $content;

    function mount()
    {
        $this->content = Cart::content();
        foreach ($this->content as $item) {
            $this->total += (double) ($item->subtotal *( 100 - $item->options->discount))/100.0;
        }
    }
   public function render()
    {
        return view('livewire.cart-icon-component', [
            'cartItems' => $this->content,
            'total' => $this->total
        ]);
    }
}
