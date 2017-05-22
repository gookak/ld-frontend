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

Auth::routes();

Route::get('/', 'HomeController@index');

Route::get('/home', 'HomeController@index');

Route::get('/profile', 'ProfileController@index');
Route::put('/profile/edit/{userId}', 'ProfileController@update');

Route::get('/product', 'ProductController@index');

Route::get('/productDetail/{id}', 'ProductController@productDetail');

Route::get('/cart', 'CartController@showCart');
Route::get('/cart/addProduct/{productId}', 'CartController@addItem');
Route::get('/cart/plusProduct/{productId}', 'CartController@plusByOne');
Route::get('/cart/reduceProduct/{productId}', 'CartController@reduceByOne');
Route::get('/cart/removeItem/{productId}', 'CartController@removeItem');


Route::get('/checkout', 'CheckoutController@index');
Route::post('/checkout/add', 'CheckoutController@store');

Route::get('/address/get', 'AddressController@getAddress');
Route::post('/address/add', 'AddressController@store');
Route::put('/address/edit/{addressId}', 'AddressController@update');
Route::get('/address/delete/{addressId}', 'AddressController@destroy');

Route::get('/order', 'OrderController@index');

Route::get('/orderDetail/{orderId}', 'OrderDetailController@index');

Route::get('/contact', 'OtherController@contact');

Route::get('/howtoshopping', 'OtherController@howto');


