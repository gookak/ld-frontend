@extends('layouts/main')

@section('tagheader')

<!-- Datatable Css -->
<link rel="stylesheet" href="{{ asset('themes/ustora/css/dataTables.bootstrap.min.css') }}" />
{{-- <link rel="stylesheet" href="{{ asset('themes/ustora/css/jquery.dataTables.min.css') }}" /> --}}
<link rel="stylesheet" href="{{ asset('themes/ustora/css/responsive.dataTables.min.css') }}" />

@endsection

@section('tagfooter')

<!-- DataTable Js -->
<script src="{{ asset('themes/ustora/js/jquery.dataTables.min.js') }}" ></script>
<script src="{{ asset('themes/ustora/js/dataTables.responsive.min.js') }}" ></script>
<script src="{{ asset('themes/ustora/js/dataTables.bootstrap.min.js') }}"></script>

@endsection

@section('content')
<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>ข้อมูลการสั่งซื้อ</h2>
                </div>
            </div>
        </div>
    </div>
</div>
</br>
<div class="single-product-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table id="tb-order" class="table table-striped table-bordered table-hover responsive nowrap shop_table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>หมายเลขของคำสั่งซื้อ</th>
                            <th></th>
                            <th>สั่งเมื่อวันที่</th>
                            <th>ยอดสุทธิ</th>
                            <th>สถานะจัดส่ง</th>
                            <th>รหัสพัสดุ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td class="center">
                                <a class="btn btn-sm btn-warning fa fa-search-plus" href="/orderDetail/{{ $order->id }}" ></a>
                                <a class="btn btn-sm btn-info fa fa-print" href="/order/{{ $order->id }}/pdf" target="_blank"></a>
                            </td>
                            <td>
                                {{-- <a href="/order/{{ $order->id }}">{{ $order->code }}</a> --}}
                                {{ $order->code }}
                            </td>
                            <td>{{ $order->created_at }}</td>
                            <td>{{ $order->created_at->addYears(543)->format('d/m/Y') }}</td>
                            <td>{{ number_format($order->totalprice,2) }} บาท</td>
                            <td style="font-size: 16px;">
                                @if($order->transportstatus->name == 'ongoing')
                                <span class="label label-info ">{{ $order->transportstatus->detail }}</span>
                                @elseif($order->transportstatus->name == 'sending')
                                <span class="label label-warning">{{ $order->transportstatus->detail }}</span>
                                @elseif($order->transportstatus->name == 'completed')
                                <span class="label label-success">{{ $order->transportstatus->detail }}</span>
                                @endif
                            </td>
                            <td>{{ $order->emscode }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div> 
        </div>
    </div>
</div>
@endsection


@section('script')
<script type="text/javascript">
    $(document).ready(function(){

        var tb_order = $('#tb-order').DataTable({
            order: [[2, "desc"]],
            columnDefs: [
            {orderable: false, targets: 0},
            {targets: 2, visible: false},
            {orderData: 2, targets: 3}
            ],
            iDisplayLength: 25,
            oLanguage: {
                "sProcessing":   "กำลังดำเนินการ...",
                "sLengthMenu":   "แสดง _MENU_ เร็คคอร์ด ต่อหน้า",
                "sZeroRecords":  "ไม่พบข้อมูล",
                "sInfo": "แสดง _START_ ถึง _END_ ของ _TOTAL_ เร็คคอร์ด",
                "sInfoEmpty": "แสดง 0 ถึง 0 ของ 0 เร็คคอร์ด",
                "sInfoFiltered": "(จากเร็คคอร์ดทั้งหมด _MAX_ เร็คคอร์ด)",
                "sInfoPostFix":  "",
                "sSearch":       "ค้นหา: ",
                "sUrl":          "",
                "oPaginate": {
                    "sFirst":    "หน้าแรก",
                    "sPrevious": "ก่อนหน้า",
                    "sNext":     "ถัดไป",
                    "sLast":     "หน้าสุดท้าย"
                }
            }
        });
    });
</script>
@endsection
