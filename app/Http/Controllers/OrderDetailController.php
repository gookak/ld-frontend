<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderDetail;
use App\TransportStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Response;
use DB;
use mPDF;

class OrderDetailController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($orderId)
    {
        $user_id = Auth::id();
        $transportstatus=TransportStatus::all();
        // $order=Order::find($orderId);
        $order = Order::where('user_id', $user_id )->where('id', $orderId)->firstOrFail();
        // dd($order);
        return view('orderDetail.index', compact('order', 'transportstatus'));
    }
    
    public function pdf($orderId)
    {
        $user_id = Auth::id();
        // $order = Order::find($orderId);
        $order = Order::where('user_id', $user_id )->where('id', $orderId)->firstOrFail();
        $filename = 'order_'.$order->code.'.pdf';
        $html = view('order.pdf', compact('order'))->render();
        $mpdf = new mPDF('th', 'A4', '', '', '15', '15', '45', '18');
        $mpdf->SetHTMLHeader(view('layouts_pdf.main')->render());
        $mpdf->setDisplayMode('fullpage');
        $mpdf->WriteHTML(file_get_contents('css/pdf.css'),1);
        $mpdf->WriteHTML($html,2);
        $mpdf->Output($filename, 'I');
        // return view('order.pdf', compact('order'));
    }
}
