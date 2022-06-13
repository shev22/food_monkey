<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;

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

Route::get('/',  'Frontend\FrontendController@index');
Route::get('category',  'Frontend\FrontendController@category');
Route::get('view-category/{slug}',  'Frontend\FrontendController@viewcategory');
Route::get('category/{cate_slug}/{prod_slug}',  'Frontend\FrontendController@productview');

Route::get('/load-cart-data',  'Frontend\CartController@cartCount');
Route::get('load-wishlist-data',  'Frontend\WishlistController@wishlistCount');








Route::post('/add-to-cart',  'Frontend\CartController@addProduct');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::post('delete-cart-item',  'Frontend\CartController@destroyProduct');
Route::post('update-cart',  'Frontend\CartController@updateCart');
Route::post('add-to-wishlist',  'Frontend\WishlistController@add');
Route::post('delete-wishlist-item',  'Frontend\WishlistController@destroy');


Route::post('delete-wishlist-item',  'Frontend\WishlistController@destroy');





Route::get('product-list',  'Frontend\FrontendController@productListAjax');
Route::post('search-product',  'Frontend\FrontendController@searchProduct');




Route::middleware(['auth'])->group(function() {

    Route::get('cart',  'Frontend\CartController@viewCart');
    Route::get('checkout',  'Frontend\CheckoutController@index');
    Route::post(' place-order',  'Frontend\CheckoutController@placeOrder');

    Route::get('my-orders',  'Frontend\UserController@index');
    Route::get('view-order/{id}',  'Frontend\UserController@view');

    Route::get('wishlist',  'Frontend\WishlistController@index');

    Route::post('proceed-to-pay',  'Frontend\CheckoutController@razorPayCheck');
    Route::post(' add-rating',  'Frontend\RatingController@add');  // Add rating to product route
    Route::get(' add-review/{product_slug}/userreview',  'Frontend\ReviewController@add');  // Add review to product route
    Route::post('add-review',  'Frontend\ReviewController@create');  // Add review to product route

 });


Route::middleware(['auth','isAdmin'])->group(function() {

    Route::get('/dashboard',  'Admin\FrontendController@index');
    Route::get('/categories',  'Admin\CategoryController@index');
    Route::get('/add-category',  'Admin\CategoryController@add');
    Route::post('/ insert-category',  'Admin\CategoryController@insert');
    Route::get('edit-category/{id}',  'Admin\CategoryController@edit');
    Route::post('update-category/{id}',  'Admin\CategoryController@update');
    Route::get('delete-category/{id}',  'Admin\CategoryController@destroy');

    Route::get('products',  'Admin\ProductController@index');
    Route::get('add-products',  'Admin\ProductController@add');
    Route::post('insert-product',  'Admin\ProductController@insert');

    Route::get('edit-product/{id}',  'Admin\ProductController@edit');
    Route::post('update-product/{id}',  'Admin\ProductController@update');
    Route::get('delete-product/{id}',  'Admin\ProductController@destroy');
 
   
    Route::get('orders',  'Admin\OrderController@orders');
    Route::get( 'admin/view-order/{id}',  'Admin\OrderController@view');

    Route::put( 'update-order/{id}',  'Admin\OrderController@updateOrder');
    Route::get( 'order-history',  'Admin\OrderController@orderHistory');
    
    Route::get('users',  'Admin\DashboardController@users');
    Route::get(' view-users/{id}',  'Admin\DashboardController@viewUser');

 });