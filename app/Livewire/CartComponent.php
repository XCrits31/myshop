<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;
use Cart;
class CartComponent extends Component
{

    public function mount()
    {
            $userId = auth()->user()->id; // Убедитесь, что пользователи авторизованы
            Cart::restore($userId);
    }
    public function qtyup($rowid): void
    {
        $product = Cart::get($rowid);
        Cart::update($rowid,$product->qty+1);
        Cart::store(auth()->id());  // Store updated cart in the database
        session()->flash('success', 'updated');
        $this->redirectRoute('cart');
    }
    public function qtydown($rowid): void
    {
        $product = Cart::get($rowid);
        Cart::update($rowid,$product->qty-1);
        Cart::store(auth()->id());  // Store updated cart in the database
        session()->flash('success', 'updated');
        $this->redirectRoute('cart');
    }
    public function delete($id): void
    {
        Cart::remove($id);
        request()->session()->flash("session", "Removed successfully");
        Cart::store(auth()->id());  // Store updated cart in the database
        session()->flash('success', 'deleted');
        $this->redirectRoute('cart');
    }
    public function clear(): \Illuminate\Http\RedirectResponse
    {
        Cart::destroy();
        Cart::store(auth()->id());  // Store updated cart in the database
        session()->flash('success', 'destroyed');
        return back();
    }
    public function render()
    {

        return view('livewire.cart-component')->with([
            //'cartItems' => $this->cartItems,
          //  'cartCount' => $this->cartCount,
        ]);
    }
}
