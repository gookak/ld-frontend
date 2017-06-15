<?php

namespace App\Http\Controllers;

use App\Order;
use App\TransportStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Response;
use DB;
use mPDF;

class OrderController extends Controller
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
    public function index()
    {
        $user_id = Auth::id();

        $orders = Order::where('user_id', $user_id )->orderBy('updated_at','desc')->get();

        return view('order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transportstatus=TransportStatus::all();
        $order=Order::find($id);
        return view('order.show', compact('order', 'transportstatus'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order=Order::find($id);
        $header_text = 'แก้ไขรายการสั่งซื้อ';
        $mode = 'edit';
        $form_action = '/order/'.$order->id;
        $transportstatusList = TransportStatus::pluck('detail', 'id')->toArray();
        return view('order.form', compact('order', 'header_text', 'mode', 'form_action', 'transportstatusList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
