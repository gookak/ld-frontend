<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\Cart;
use App\User;
use App\Address;
use App\Order;
use App\OrderDetail;
use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use Response;

class CheckoutController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $user_id = Auth::id();
        $profile = User::find($user_id);

        return view('checkout.form',compact('profile'));
    }

    public function store(Request $request)
    {
        $status = 200;
        $msgerror = "";

        $user_id = Auth::id();
        $addressId = $request->input('addressid');
        $fullname = $request->input('fullname');
        $detail = $request->input('detail');
        $postcode = $request->input('postcode');
        $tel = $request->input('tel');

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $products = $cart->items;
        $totalQty = $cart->totalQty;
        $totalPrice = $cart->totalPrice;

        DB::beginTransaction();
        try{

            if(count($products)){
                $i=1;
                foreach ($products as $product) {
                    $productbal = Product::find($product['item']['id']);
                    $over = $productbal->balance - $product['qty'];
                    if($over < 0){
                        $i == 1 ? $msgerror = $msgerror."สินค้าหมด</br>" : null;
                        $msgerror = $msgerror.$i.". ".$productbal->name." เหลือสินค้า ".$productbal->balance." ชิ้น </br>" ;
                   }
                   $i++;
               }
            }

            if($msgerror == ""){
                if(!$addressId){
                    Address::create([
                        'user_id' => $user_id,
                        'fullname' => $fullname,
                        'detail' => $detail,
                        'postcode' => $postcode,
                        'tel' => $tel
                        ]);
                }
                $or = Order::create([
                    'transportstatus_id' => 1,
                    'user_id' => $user_id,
                    'code' => $this->GeraHash(10),
                    'sumnumber' => $totalQty,
                    'sumprice' => $totalPrice,
                    'fee' => 0,
                    'promotion' => 0,
                    'totalprice' => $totalPrice,
                    'address' => $fullname." ".$detail
                    ]);
                if(count($products)){
                    foreach ($products as $product) {
                        $ord = OrderDetail::create([
                            'order_id' => $or->id,
                            'product_id' => $product['item']['id'],
                            'number' => $product['qty'],
                            'price' => $product['item']['price']
                            ]);

                        $pb = Product::find($product['item']['id']);
                        $balance = $pb->balance - $product['qty'];
                        Product::where('id', $pb->id)->update(['balance' => $balance]);
                    }
                }
                Session::forget('cart');
            }else{
                $status = 501;
            }
        } catch (\Exception $ex) {
            DB::rollback();
            $status = 500;
            $msgerror = $ex->getMessage();
        }
        DB::commit();
        if ($msgerror == "") {
            $msgerror = 'บันทึกข้อมูลเรียบร้อย';
        }
        $data = ['status' => $status, 'msgerror' => $msgerror, 'url' => "/home" , 'orderId' => $or->id ]; //"orderId" => $or->id
        return Response::json($data);
    }

public function GeraHash($qtd){ 
    //Under the string $Caracteres you write all the characters you want to be used to randomly generate the code. 
    $Caracteres = 'ABCDEFGHIJKLMOPQRSTUVXWYZ0123456789'; 
    $QuantidadeCaracteres = strlen($Caracteres); 
    $QuantidadeCaracteres--; 

    $Hash=NULL; 
    for($x=1;$x<=$qtd;$x++){ 
        $Posicao = rand(0,$QuantidadeCaracteres); 
        $Hash .= substr($Caracteres,$Posicao,1); 
    } 
    return $Hash; 
} 
}