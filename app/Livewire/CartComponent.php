<?php

namespace App\Livewire;

use App\Models\Category;
use DB;
use Livewire\Component;
use Cart;
class CartComponent extends Component
{
    private $total = 0;
    private $total_discount = 0;
    private $end =[];
    public function mount()
    {
        $userId = auth()->user()->id;
        Cart::restore($userId);
        $disclsit = [];

        $discounts = DB::table('discount_rules')->get();
        $categories = DB::table('mycategories')->get();
        $catprod = DB::table('category_product')->get();
        $this->total();
        $totalPercent = 0;

            foreach($discounts as $discount) {
                $data = json_decode($discount->data, true);

                $random = $data['random'];
                $categoriesInvolved = $data['categories_involved'];
                $excludedProducts = $data['excluded_products'];
                $discount_info = $data['discount_info'];
                $discount_partial = $data['discount_partial'];
                $discountPercent = $data['discount_percent'];

                    $call = $this->CartDiscount($categoriesInvolved, $excludedProducts, Cart::content(), $categories, $random);
                    if ($call) {
                        $disclsit[] = $discount;
                        if ($discount_info == 'total') {
                            $totalPercent += $discountPercent;
                        } else if ($discount_info == 'partial_cat') {
                            $prodarr = [];
                            foreach($catprod as $prod) {
                                foreach ($discount_partial as $part){
                                    if ($prod->category_id == $part){
                                        $prodarr[] = $prod->product_id;
                                    }
                            }
                                }
                            foreach (Cart::content() as $cont) {
                                foreach ($prodarr as $prod) {
                                    if ($cont->id == $prod){
                                        $this->total_discount += ($cont->subtotal * $discountPercent) / 100.0;
                                    }
                                }
                            }
                        }
                        } else if ($discount_info == 'partial_prod') {
                        foreach (Cart::content() as $cont) {
                            foreach ($discount_partial as $prod) {
                                if ($cont->id == $prod){
                                    $this->total_discount += ($cont->subtotal * $discountPercent) / 100.0;
                                }
                            }
                        }
                        }


            }
        $this->end = array_unique($disclsit);
        $this->total_discount += (($this->total - $this->total_discount) * $totalPercent) / 100.0;
    }
    public function total() : void{
        foreach (Cart::content() as $product) {
            $this->total += $product->price * $product->qty;
            $this->total_discount += (($product->price*$product->qty) - (($product->price - ($product->price * ($product->options->discount / 100))) * $product->qty));
        }

    }
    public function CartDiscount($categoriesInvolved, $excludedProducts, $content, $categories, $random) : bool
    {
        $arr = [];
        $count = DB::table('mycategories')->count();
        foreach($categories as $category){
        $arr[] = [$category->name, 0];
    }

        foreach($content as $prod){ //full cart cost (arr)
            $flag = false;
            foreach($excludedProducts as $excludedProduct){
                if($excludedProduct == $prod->id){$flag = true;}
            }
            if($flag)continue;
            $categories = $this->prodcat($prod->id);
            $i = 0;
            while ($i < $count) {
                foreach($categories as $category){
                    if($arr[$i][0] == $category[0]){
                        $arr[$i][1]+=$prod->qty;
                    }
                }
                $i++;
            }
        }
       // dd($arr);
        if($random == 0) {
            $i = 0;
            $flag = false;
            while ($i < $count) {

                foreach ($categoriesInvolved as $category) {
                    if ($arr[$i][0] == $category[0]) {
                        if ($arr[$i][1] >= $category[1]) {
                            $flag = true;
                            continue;
                        } else {
                            return false;
                        }
                    }
                }
                $i++;
                if (!$flag) {
                    return false;
                }
            }
            return true;
        }

        else{
            $i = 0;
            $randomed = 0;

            while ($i < $count) {
                if ($arr[$i][1] > 0) {
                    $randomed++;
                }
                $i++;
        }
        if($random <= $randomed){
            return true;
        }
        else return false;
                }
    }
    public function prodcat($id)//product cost (categories)
    {
        $arr = [];
        $categories = DB::table('mycategories')->get();
        $product = DB::table('myproducts')->get();
        $catprod = DB::table('category_product')->get();
        foreach($catprod as $try){
            if($try->product_id == $id){
                foreach($categories as $category){
                    if($category->id == $try->category_id){
                        $arr[] = [$category->name];
                    }
                }
            }
        }
        return $arr;
    }
    public function qtyup($rowid): void
    {
        if(!$this->CheckRow($rowid)){
            session()->flash('error', 'not found in cart');
            $this->redirectRoute('cart');
            return;
        }
        $product = Cart::get($rowid);
        Cart::update($rowid,$product->qty+1);
        Cart::store(auth()->id());
        //session()->flash('success', 'updated');
        //$this->redirectRoute('cart');
    }
    public function qtydown($rowid): void
    {
        if(!$this->CheckRow($rowid)){
            session()->flash('error', 'not found in cart');
            $this->redirectRoute('cart');
            return;
        }
        $product = Cart::get($rowid);
            Cart::update($rowid, $product->qty -= 1);

            Cart::store(auth()->id());
            //session()->flash('success', 'updated');
            //$this->redirectRoute('cart');

    }
    public function delete($id): void
    {

                Cart::remove($id);
                request()->session()->flash("session", "Removed successfully");
                Cart::store(auth()->id());
                session()->flash('success', 'deleted');
                $this->redirectRoute('cart');

    }
    public function clear(): \Illuminate\Http\RedirectResponse
    {
        Cart::destroy();
        Cart::store(auth()->id());
        session()->flash('success', 'destroyed');
        return back();
    }
    function Check($id) {
        foreach (Cart::content() as $item) {
            if ($item->id == $id) {
                return true;
            }
        }
        return false;
    }
    function CheckRow($rowid) {
        foreach (Cart::content() as $item) {
            if ($item->rowId == $rowid) {
                return true;
            }
        }
        return false;
    }
    public function render()
    {

        return view('livewire.cart-component')->with([
            'total' => round($this->total, 2),
            'distotal' => round($this->total_discount, 2),
            'discounts' => $this->end
        ]);
    }
}
