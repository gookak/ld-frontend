<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\Cart;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use DB;
use Session;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index(){

        $user_id = Auth::id();
        // echo $user_id;
        $profile = User::find($user_id);

    	$oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $products = $cart->items;
        $totalQty = $cart->totalQty;
        $totalPrice = $cart->totalPrice;

        // return view('checkout.index',['products' => $cart->items, 'totalQty'=>$cart->totalQty, 'totalPrice'=>$cart->totalPrice]);

        return view('checkout.index',compact('profile','products','totalQty','totalPrice'));
    }
}