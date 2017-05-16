<?php

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


Route::get('/', 'HomeController@index');

// Route::get('/product', 'ProductController@index');

Route::get('/product', 'ProductController@index');

// Route::get('/product/{category_id}', 'ProductController@searchCategory');

// Route::get('/product/search', 'ProductController@search');

Route::get('/productDetail/{id}', 'ProductController@productDetail');

Route::get('/cart', 'CartController@showCart');
Route::get('/cart/addProduct/{productId}', 'CartController@addItem');
Route::get('/cart/plusProduct/{productId}', 'CartController@plusByOne');
Route::get('/cart/reduceProduct/{productId}', 'CartController@reduceByOne');
Route::get('/cart/removeItem/{productId}', 'CartController@removeItem');


Route::get('/checkout', 'CheckoutController@index');
// Route::get('/', function () {
//     return view('home');
// });
