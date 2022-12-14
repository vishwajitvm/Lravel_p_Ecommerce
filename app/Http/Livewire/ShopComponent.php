<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Foundation\Testing\WithoutEvents;
use Livewire\Component;
use Livewire\WithPagination ;
use App\Models\Category ;

class ShopComponent extends Component
{
    public $sorting ;
    public $pagesize ;

    public function mount() {
        $this->sorting = "defualt" ;
        $this->pagesize = 12 ;
    }

    public function store($product_id , $product_name , $product_price ) {
        Cart::add($product_id , $product_name , 1 , $product_price)->associate('App\Models\Product') ; 
        session()->flash('success_message' , 'Item added in cart') ;
        return redirect()->route('product.cart') ;
    }

    use WithPagination ;
    public function render()
    {
        //filtering
        if ($this->sorting == 'date') {
            $products = Product::orderBy('created_at' , 'DESC')->paginate($this->pagesize) ;
        }
        else if($this->sorting == 'price') {
            $products = Product::orderBy('regular_price' , 'ASC')->paginate($this->pagesize) ;
        }
        else if($this->sorting == 'price-desc') {
            $products = Product::orderBy('regular_price' , 'DESC')->paginate($this->pagesize) ;
        }
        else {
            $products = Product::paginate(12) ;
        }

        $categories = Category::all() ;
        
        // $products = Product::paginate(12) ;
        return view('livewire.shop-component' , ['products' => $products , 'categories' => $categories])->layout('layouts.base');
    }
}
