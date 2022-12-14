<?php

use App\Http\Livewire\Admin\AdminAddCategoryComponent;
use App\Http\Livewire\Admin\AdminAddProductComponent;
use App\Http\Livewire\Admin\AdminCategoryComponent;
use App\Http\Livewire\Admin\AdminDashboardComponent;
use App\Http\Livewire\Admin\AdminEditCategory;
use App\Http\Livewire\Admin\AdminEditProductComponent;
use App\Http\Livewire\Admin\AdminProductComponent;
use App\Http\Livewire\CartComponent;
use App\Http\Livewire\CategoryComponent;
use App\Http\Livewire\CheckoutComponent;
use App\Http\Livewire\DetailsComponent;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\SearchComponent;
use App\Http\Livewire\ShopComponent;
use App\Http\Livewire\User\UserDashboardComponent;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::middleware([
//     'auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });


Route::get('/' , HomeComponent::class) ;

Route::get('/shop' , ShopComponent::class) ;

Route::get('/cart' , CartComponent::class)->name('product.cart') ;

Route::get('/checkout' , CheckoutComponent::class) ;

//*****PRODUCT DETAILS*****
Route::get('/product/{slug}' , DetailsComponent::class)->name('product.details') ;

//*****PRODUCT CATEGORY*****
Route::get('/product-category/{category_slug}' , CategoryComponent::class)->name('product.category') ;

//*****PRODUCT SEARCH RESULT*****
Route::get('/search' , SearchComponent::class)->name('product.search') ;


//Dashboard route for USER
Route::middleware(['auth:sanctum' ,  'verified'])->group(function() {
    Route::get('/user/dashboard', UserDashboardComponent::class)->name('user.dashboard') ;
}) ;

//Dashboard route for ADMIN
Route::middleware(['auth:sanctum' ,  'verified' , 'authadmin'])->group(function() {
    //Category
    Route::get('/admin/dashboard', AdminDashboardComponent::class)->name('admin.dashboard') ;
    Route::get('/admin/categories', AdminCategoryComponent::class)->name('admin.categories') ;
    Route::get('/admin/category/add', AdminAddCategoryComponent::class)->name('admin.addcategory') ;
    Route::get('/admin/category/edit/{category_slug}', AdminEditCategory::class)->name('admin.editcategory') ;

    //Admin Product
    Route::get('/admin/products', AdminProductComponent::class)->name('admin.products') ;
    Route::get('/admin/product/add', AdminAddProductComponent::class)->name('admin.addproduct') ;
    Route::get('/admin/product/edit/{product_slug}', AdminEditProductComponent::class)->name('admin.editproduct') ;
}) ;

