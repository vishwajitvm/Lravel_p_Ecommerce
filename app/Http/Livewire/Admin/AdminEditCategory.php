<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Str ;

class AdminEditCategory extends Component
{
    public $category_slug ;
    public $category_id ;
    public $name ;

    public function mount($category_slug) {
        $this->category_slug = $category_slug ;
        $category = Category::where('slug' , $category_slug)->first() ;
        $this->category_id = $category->id ;
        $this->name = $category->name ;
        $this->slug = $category->slug ;

    }

    //genrate slug 
    public function generateslug() {
        $this->slug = Str::slug($this->name) ;
    }

    //update category
    public function updateCategory() {
        $category = Category::find($this->category_id) ;
        $category->name = $this->name ;
        $category->slug = $this->slug ;
        $category->save() ;
        return redirect()->route('admin.categories')->with('message' , 'Category has been updated successfully') ;

    }

    public function render()
    {
        return view('livewire.admin.admin-edit-category')->layout('layouts.base');
    }
}
