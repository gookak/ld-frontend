<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\OrderDetail;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Mylibs\Mylibs;

class ProductController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index(Request $request)
    {

        $name = $request->input('name');
        $categoryId = $request->input('category_id')? $request->input('category_id') : 1;
        $price_min = $request->input('price_min');
        $price_max = $request->input('price_max');
        $sortby = $request->input('sortby');
        
        $category_list = Category::all();
        $category = Category::find($request->input('category_id'));
        $category_current = Category::find($categoryId);
        $maxprice = Product::max('price');
        // $minprice = Product::where('category_id', $categoryId)->min('price');
        // $tbl_product = DB::table('product');

        $tbl_product = Product::where('category_id', 'like', $categoryId);

        

        if ($name) {
            $tbl_product = $tbl_product->where('name', 'like', '%' . $name . '%');
        }

        // if ($categoryId) {
        //     $tbl_product = $tbl_product->where('category_id', 'like', $categoryId);
        // }else{
        //     $tbl_product = $tbl_product->where('category_id', 'like', $categoryId);
        // }

        if ($price_min || $price_max) {
            $tbl_product = $tbl_product->whereBetween('price', [$price_min, $price_max]);
        }

        if ($sortby == "latest"){
            $tbl_product = $tbl_product->orderBy('created_at','desc');
        }else if($sortby == "pricedesc"){
            $tbl_product = $tbl_product->orderBy('price','desc');
        }else if ($sortby == "priceasc") {
            $tbl_product = $tbl_product->orderBy('price','asc');
        }

        
        $products = $tbl_product->paginate(15);

        $topseller = OrderDetail::selectRaw("product_id,sum(number) as qty")
        ->groupBy('product_id')
        ->orderBy('qty','desc')
        ->take(5)
        ->get();

        foreach ($products  as $key => $product) {
            foreach ($topseller  as $key => $seller) {
                if($seller->product_id == $product->id ){
                    $product['hot'] = 1;
                }
            }
            $product['numdate'] = Mylibs::getNumDay($product->created_at->format('Y-m-d'), date("Y-m-d"));
        }

        return view('product.index',compact('products','category_list','category_current','maxprice'));
    }


    public function productDetail($id)
    {

        $product = Product::find($id); 
        $category_list = Category::all();
        $maxprice = Product::max('price'); 

        $topseller = OrderDetail::selectRaw("product_id,sum(number) as qty")
        ->groupBy('product_id')
        ->orderBy('qty','desc')
        ->take(5)
        ->get();

        foreach ($topseller  as $key => $seller) {
            if($seller->product_id == $product->id ){
                $product['hot'] = 1;
            }
        }
        $product['numdate'] = Mylibs::getNumDay($product->created_at->format('Y-m-d'), date("Y-m-d"));

        return view('product.detail',compact('product','category_list','maxprice'));
    }

}
