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
Route::get('/profile/repass', 'ProfileController@showrepass');
// Route::put('/profile/edit/{userId}', 'ProfileController@update');
// Route::put('/profile/edit/{userId}/mail', 'ProfileController@updatemail');
// Route::put('/profile/repass/{userId}', 'ProfileController@repass');
Route::post('/profile/edit/{userId}', 'ProfileController@update');
Route::post('/profile/edit/{userId}/mail', 'ProfileController@updatemail');
Route::post('/profile/repass/{userId}', 'ProfileController@repass');

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
Route::post('/address/edit/{addressId}', 'AddressController@update');
Route::get('/address/delete/{addressId}', 'AddressController@destroy');

Route::get('/order', 'OrderController@index');
Route::get('/order/{orderId}/pdf', 'OrderController@pdf');

Route::get('/orderDetail/{orderId}', 'OrderDetailController@index');
Route::get('/orderDetail/{orderId}/pdf', 'OrderDetailController@pdf');

Route::get('/contact', 'OtherController@contact');

Route::get('/howtoshopping', 'OtherController@howto');


