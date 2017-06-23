@extends('layouts/main')

@section('tagheader')


<!-- bootstrap & fontawesome -->
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
<link rel="stylesheet" href="{{ asset('font-awesome/4.5.0/css/font-awesome.min.css') }}" />
<!-- text fonts -->
<link rel="stylesheet" href="{{ asset('css/fonts.googleapis.com.css') }}" />

<!-- ace styles -->
<link rel="stylesheet" href="{{ asset('css/ace.min.css') }}" class="ace-main-stylesheet" id="main-ace-style" />

<link rel="stylesheet" href="{{ asset('css/ace-skins.min.css') }}" />
<link rel="stylesheet" href="{{ asset('css/ace-rtl.min.css') }}" />


@endsection

@section('tagfooter')
<!-- ace settings handler -->
<script src="{{ asset('js/ace-extra.min.js') }}"></script>

@endsection

@section('content')
<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>รายละเอียดรายการสั่งซื้อ</h2>
                </div>
            </div>
        </div>
    </div>
</div>
</br>
<div class="single-product-area">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="widget-box transparent">
                    <div class="widget-header widget-header-large">
                        <h3 class="widget-title">
                            หมายเลขรายการสั่งซื้อ {{ $order->code }}
                        </h3>

                        <div class="widget-toolbar no-border invoice-info">
                            <br>
                            <span class="invoice-info-label">วันที่สั่งซื้อ:</span>
                            <span class="blue">{{ $order->created_at->addYears(543)->format('d/m/Y') }}</span>
                        </div>
                        <div class="widget-toolbar hidden-480">
                            <a href="/orderDetail/{{ $order->id }}/pdf" target="_blank">
                                <i class="ace-icon fa fa-print"></i>
                            </a>
                        </div>
                    </div>

                    <div class="widget-body">
                        <div class="widget-main padding-24">
                            <div class="row">
                                @if($transportstatus)
                                <ul class="steps">
                                    @foreach($transportstatus as $index => $transport)
                                    <li data-step="{{ $transport->id }}" class="{{ $order->transportstatus_id == $transport->id ? 'active' : null }}">
                                        <span class="step">{{ ++$index }}</span>
                                        <span class="title">{{ $transport->detail }}</span>
                                    </li>
                                    @endforeach
                                </ul>
                                @endif
                            </div>

                            <div class="space"></div>

                            @if( $order->orderdetail )
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="center">รหัส</th>
                                        <th>ชื่อ</th>
                                        <th class="hidden-xs">รายละเอียด</th>
                                        <th>ราคา</th>
                                        <th>จำนวน</th>
                                        <th>รวม</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach( $order->orderdetail as $od )
                                    <tr>
                                        <td class="center">{{ $od->product->code }}</td>
                                        <td>{{ $od->product->name }}</td>
                                        <td class="hidden-xs">{{ $od->product->detail }}</td>
                                        <td>{{ number_format($od->price,2) }} บาท</td>
                                        <td>{{ $od->number }}</td>
                                        <td>{{ number_format($od->price * $od->number,2)}} บาท</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @endif

                            <div class="hr hr8 hr-double hr-dotted"></div>

                            <div class="space"></div>

                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="widget-box">
                                        <div class="widget-body">
                                            <div class="widget-main">
                                                <ul class="list-unstyled">
                                                    <li class="text-primary"><b>ที่อยู่สำหรับจัดส่งสินค้า</b></li>
                                                    <li>{{ $order->address }}</li>
                                                    <li class="text-primary"><b>รหัสพัสดุ</b></li>
                                                    <li>{{ $order->emscode ? $order->emscode : '-' }}</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="widget-box">
                                        <div class="widget-body">
                                            <div class="widget-main">
                                                <ul class="list-unstyled">
                                                    <li class="text-primary"><b>สรุปยอกการสั่งซื้อ</b></li>
                                                    <li>จำนวนสินค้าทั้งหมด <b class="text-primary">{{ $order->sumnumber }}</b> ชิ้น</li>
                                                    <li>มูลค่าสินค้า <b class="text-primary">{{ number_format($order->sumprice,2) }}</b> บาท</li>
                                                    <li>ค่าธรรมเนียม <b class="text-primary">{{ number_format($order->fee,2) }}</b> บาท</li>
                                                    <li>ส่วนลด <b class="text-primary">{{ number_format($order->promotion,2) }}</b> บาท</li>
                                                    <li>ยอดสุทธิ <b class="text-primary">{{ number_format($order->totalprice,2) }}</b> บาท</li>
                                                    <li><b class="text-primary">{{ $order->totalPriceThai }}</b></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="hr hr8 hr-double hr-dotted"></div>

                            <div class="space"></div>

                            <div class="row">
                                <div class="col-xs-12 text-center">
                                    <a href="/order" class="btn btn-default"><i class="ace-icon fa fa-reply"></i> กลับ</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


@section('script')
<script type="text/javascript">
    $(document).ready(function(){

    });
</script>
@endsection