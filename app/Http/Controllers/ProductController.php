<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use Illuminate\Http\Request;
use DB;

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
        $tbl_product = DB::table('product');

        $maxprice = Product::max('price');
        // $minprice = Product::where('category_id', $categoryId)->min('price');

        if ($name) {
            $tbl_product = $tbl_product->where('name', 'like', '%' . $name . '%');
        }

        if ($categoryId) {
            $tbl_product = $tbl_product->where('category_id', 'like', $categoryId);
        }else{
            $tbl_product = $tbl_product->where('category_id', 'like', $categoryId);
        }

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

        $category_current = Category::find($categoryId);
        $products = $tbl_product->paginate(2);

        // dd($products);

        return view('product.index',compact('products','category_list','category_current','maxprice','minprice'));
    }


    public function productDetail($id)
    {

        $product = Product::find($id); 
        $category_list = Category::all();
        $maxprice = Product::max('price');       
        return view('product.detail',compact('product','category_list','maxprice'));
    }

}
