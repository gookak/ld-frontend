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

class CheckoutController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index(){

    	$oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $products = $cart->items;

        return view('checkout.index',['products' => $cart->items, 'totalQty'=>$cart->totalQty, 'totalPrice'=>$cart->totalPrice]);
    }
}