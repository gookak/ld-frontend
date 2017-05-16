<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\Cart;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Cookie\CookieJar;
use App\Http\Requests;
use DB;
use Session;
use Cookie;
class CartController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function addItem (CookieJar $cookieJar,Request $request, $productId){

        $product = Product::find($productId);
        $qty = $request->input('qty')? $request->input('qty') : 1;


        /* Cart by Session */

        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product,$product->id,$qty);
        $request->session()->put('cart',$cart);

        // dd($request->session()->get('cart'));    

        // return redirect("/product");  

        /* Cart by Cookie */
        // $oldCart = Cookie::get('cart') ? Cookie::get('cart') : null;
        // // $oldCart = $request->cookie('cart') ? $request->cookie('cart') : null;
        
        // $cart = new Cart($oldCart);
        // $cart->add($product,$product->id,$qty);

        // // $cart = $cookieJar->getQueuedCookies($cart);
        
        // $cookieJar->queue('cart', $cart); 
        // dd(Cookie::get('cart'));
    }

    public function reduceByOne($productId) {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->reduceByOne($productId);
        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }
        // return redirect()->route('product.shoppingCart');
    }

    public function plusByOne($productId) {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->plusByOne($productId);
        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }
        // return redirect()->route('product.shoppingCart');
    }

    public function showCart(){

        /* Cart by Cookie */

        // $oldCart = Cookie::get('cart');
        // $cart = new Cart($oldCart);
        // $products = $cart->items;

        /* Cart by Session */

        // if(Session::has('cart')){
        //     return view('cart.index',compact('products => null'));
        // }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $products = $cart->items;

        return view('cart.index',['products' => $cart->items, 'totalQty'=>$cart->totalQty, 'totalPrice'=>$cart->totalPrice]);
    }

    public function removeItem($productId) {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($productId);
        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }
        // return redirect()->route('product.shoppingCart');
    }
}
