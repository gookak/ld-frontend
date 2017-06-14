<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\Cart;
use App\User;
use App\Address;
use Illuminate\Http\Request;
// use Illuminate\Http\Response;
use Illuminate\Cookie\CookieJar;
use App\Http\Requests;
use DB;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Response;
use Cookie;
class CartController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function addItem (CookieJar $cookieJar,Request $request, $productId){

        $status = 200;
        $msgerror = "";

        $product = Product::find($productId);
        $image = "";
        if(count($product->productImage)){
            $image = $product->productImage[0]->fileupload->filename;
        }
        $qty = $request->input('qty')? $request->input('qty') : 1;



        /* Cart by Session */

        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product,$product->id,$qty,$image);

        // dd($cart->items[$product->id]['qty']);   

        if($product->balance < $cart->items[$product->id]['qty']){
            $status = 500;
            $msgerror = "สินค้าไม่พอ</br>";
            $msgerror = $msgerror.$product->name." เหลือสินค้า ".$product->balance." ชิ้น </br>" ;

        }else{
            $msgerror = 'เพิ่มสินค้าลงตระกร้าเรียบร้อย';
            $request->session()->put('cart',$cart);
        }

        $data = ['status' => $status, 'msgerror' => $msgerror, 'url' => "/product span.cart-item"]; 
        return Response::json($data);



        // dd($request->session()->get('cart'));    

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
        $user_id = Auth::id();
        $profile = User::find($user_id);
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $products = $cart->items;
        $totalQty = $cart->totalQty;
        $totalPrice = $cart->totalPrice;

        // return view('cart.index',['products' => $cart->items, 'totalQty'=>$cart->totalQty, 'totalPrice'=>$cart->totalPrice]);
        return view('cart.index',compact('profile','products','totalQty','totalPrice'));
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
