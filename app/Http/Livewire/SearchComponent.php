<?php
// class SearchComponent extends Component
// {
//     public function render()
//     {
//         return view('livewire.search-component')->layout('layouts.base');
//     }
// }

namespace App\Http\Livewire;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Foundation\Testing\WithoutEvents;
use Livewire\Component;
use Livewire\WithPagination ;
use App\Models\Category ;

class SearchComponent extends Component
{
    public $sorting ;
    public $pagesize ;

    public $search ;
    public $product_cat ;
    public $product_cat_id ;


    public function mount() {
        $this->sorting = "defualt" ;
        $this->pagesize = 12 ;
        $this->fill(request()->only('search' , 'product_cat' , 'product_cat_id') ) ;
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
            $products = Product::where('name' , 'like' , '%'.$this->search.'%' )->where('category_id' , 'like' , '%'.$this->product_cat_id.'%' )->orderBy('created_at' , 'DESC')->paginate($this->pagesize) ;
        }
        else if($this->sorting == 'price') {
            $products = Product::where('name' , 'like' , '%'.$this->search.'%' )->where('category_id' , 'like' , '%'.$this->product_cat_id.'%' )->orderBy('regular_price' , 'ASC')->paginate($this->pagesize) ;
        }
        else if($this->sorting == 'price-desc') {
            $products = Product::where('name' , 'like' , '%'.$this->search.'%' )->where('category_id' , 'like' , '%'.$this->product_cat_id.'%' )->orderBy('regular_price' , 'DESC')->paginate($this->pagesize) ;
        }
        else {
            $products = Product::where('name' , 'like' , '%'.$this->search.'%' )->where('category_id' , 'like' , '%'.$this->product_cat_id.'%' )->paginate(12) ;
        }

        $categories = Category::all() ;
        
        // $products = Product::paginate(12) ;
        return view('livewire.search-component' , ['products' => $products , 'categories' => $categories])->layout('layouts.base');
    }
}
