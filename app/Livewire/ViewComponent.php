<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\DiscountRule;
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
        $this->disc = DiscountRule::all();
        $this->all = Category::all();
    }

    public function render()
    {
        return view('livewire.view-component', [
            'category' => $this->category,
            'products' => $this->products,
            'discount' => $this->disc
        ]);
    }
    public function store($product_id, $product_name, $product_price,$discount, $user_id) : void
    {
        //$check = Cart::count();
        Cart::add($product_id, $product_name, 1, $product_price,['discount' => $discount])->associate('App\Models\Product');
        /*if($check == 0){
            Cart::add(9999,'discount',1,0);
        }*/
        Cart::store($user_id);
        session()->flash('success', 'Added to Cart');
        $this->redirectRoute('cart');
    }

}
