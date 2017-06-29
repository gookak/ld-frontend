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
use Carbon\Carbon;
use App\Mylibs\Mylibs;

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

        $order['totalPriceThai'] = $this->getConvertNumberString($order->totalprice);

        return view('orderDetail.index', compact('order', 'transportstatus'));
    }
    
    public function pdf($orderId)
    {
        $user_id = Auth::id();
        $name = Auth::user()->firstname.' '.Auth::user()->lastname;
        // $order = Order::find($orderId);
        $order = Order::where('user_id', $user_id )->where('id', $orderId)->firstOrFail();

        $order['totalPriceThai'] = $this->getConvertNumberString($order->totalprice);

        $filename = 'order_'.$order->code.'.pdf';
        $html = view('orderDetail.pdf', compact('order'))->render();
        $mpdf = new mPDF('th', 'A4', '', '', '15', '15', '45', '18');
        $mpdf->SetHTMLHeader(view('layouts_pdf.main')->render());
        $mpdf->SetFooter('|{PAGENO}/{nbpg}|'
            .' พิมพ์โดย '.$name
            .'<br>'
            .'วันที่พิมพ์ '.Carbon::now('asia/bangkok')->addYears(543)->format('d/m/Y H:i'));
        // $mpdf->setFooter("หน้า {PAGENO}/{nb}");
        $mpdf->setDisplayMode('fullpage');
        $mpdf->WriteHTML(file_get_contents('css/pdf.css'),1);
        $mpdf->WriteHTML($html,2);
        $mpdf->Output($filename, 'I');
        // return view('order.pdf', compact('order'));
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
