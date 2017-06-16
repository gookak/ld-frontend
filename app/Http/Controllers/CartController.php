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
        $totalPriceThai = $this->getConvertNumberString( $totalPrice );

        // return view('cart.index',['products' => $cart->items, 'totalQty'=>$cart->totalQty, 'totalPrice'=>$cart->totalPrice]);
        return view('cart.index',compact('profile','products','totalQty','totalPrice', 'totalPriceThai'));
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

    public function getConvertNumberString($amount_number)
    {
        $amount_number = number_format($amount_number, 2, ".","");
        $pt = strpos($amount_number , ".");
        $number = $fraction = "";
        if ($pt === false) 
            $number = $amount_number;
        else
        {
            $number = substr($amount_number, 0, $pt);
            $fraction = substr($amount_number, $pt + 1);
        }

        $ret = "";
        $baht = $this->ReadNumber ($number);
        if ($baht != "")
            $ret .= $baht . "บาท";

        $satang = $this->ReadNumber($fraction);
        if ($satang != "")
            $ret .=  $satang . "สตางค์";
        else 
            $ret .= "ถ้วน";
        return $ret;
    }

    private function ReadNumber($number)
    {
        $position_call = array("แสน", "หมื่น", "พัน", "ร้อย", "สิบ", "");
        $number_call = array("", "หนึ่ง", "สอง", "สาม", "สี่", "ห้า", "หก", "เจ็ด", "แปด", "เก้า");
        $number = $number + 0;
        $ret = "";
        if ($number == 0) return $ret;
        if ($number > 1000000)
        {
            $ret .= ReadNumber(intval($number / 1000000)) . "ล้าน";
            $number = intval(fmod($number, 1000000));
        }

        $divider = 100000;
        $pos = 0;
        while($number > 0)
        {
            $d = intval($number / $divider);
            $ret .= (($divider == 10) && ($d == 2)) ? "ยี่" : 
            ((($divider == 10) && ($d == 1)) ? "" :
                ((($divider == 1) && ($d == 1) && ($ret != "")) ? "เอ็ด" : $number_call[$d]));
            $ret .= ($d ? $position_call[$pos] : "");
            $number = $number % $divider;
            $divider = $divider / 10;
            $pos++;
        }
        return $ret;
    }
}
