<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\OrderDetail;
use Illuminate\Http\Request;
use DB;

class OtherController extends Controller
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
    public function contact()
    {
        return view('contact.index');
    }

    public function howto()
    {
        return view('howto.shopping');
    }
}
