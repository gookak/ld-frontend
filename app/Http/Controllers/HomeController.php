<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\OrderDetail;
use Illuminate\Http\Request;
use Response;
use DB;
use Carbon\Carbon;
use App\Mylibs\Mylibs;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $date = date("Y-m-d");
        $date = strtotime($date);
        $date = strtotime("-7 day", $date);
        date('Y-m-d', $date);

        

        // $productlatest = Product::orderBy('created_at','desc')->get();
        $productlatest = Product::whereDate('created_at', '>=', date('Y-m-d', $date))->orderBy('created_at','desc')->get();
        $category_list = Category::all();      //inRandomOrder()->take(5)->get();
        $topsellers = OrderDetail::selectRaw("product_id,sum(number) as qty")
        ->groupBy('product_id')
        ->orderBy('qty','desc')
        ->take(5)
        ->get();

        foreach ($productlatest  as $key => $product) {
            foreach ($topsellers  as $key => $seller) {
                if($seller->product_id == $product->id ){
                    $product['hot'] = 1;
                }
            }
        }

        // foreach ($topsellers  as $key => $topseller) {
        //     foreach ($topseller->product  as $key => $product) {
        //         $product['numdate'] = Mylibs::getNumDay($product->created_at->format('Y-m-d'), date("Y-m-d"));
        //     }
        // }

        foreach ($category_list  as $key => $category) {
            foreach ($category->product  as $key => $product) {
                foreach ($topsellers  as $key => $seller) {
                    if($seller->product_id == $product->id ){
                        $product['hot'] = 1;
                    }
                }
                $product['numdate'] = Mylibs::getNumDay($product->created_at->format('Y-m-d'), date("Y-m-d"));
            }
        }

        return view('home',compact('productlatest','topsellers','category_list'));
    }
}
