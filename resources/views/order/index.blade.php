@extends('layouts/main')

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
                            <th class="text-center">
                                <input type="checkbox" id="checkAll" name="checkAll" value="1">
                            </th>
                            <th></th>
                            <th>หมายเลขของคำสั่งซื้อ</th>
                            <th>สั่งเมื่อวันที่</th>
                            <th>ยอดสุทธิ</th>
                            <th>สถานะจัดส่ง</th>
                            <th>รหัสพัสดุ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td>
                                <input type="checkbox" class="check" id="checkAll" name="checkAll" value="{{$order->id}}">
                            </td>
                            <td class="center">
                                <a class="btn btn-sm btn-warning fa fa-search-plus" href="/orderDetail/{{ $order->id }}" ></a>
                                <a class="btn btn-sm btn-info fa fa-print" href="/orderDetail/{{ $order->id }}" ></a>
                            </td>
                            <td>
                                {{-- <a href="/order/{{ $order->id }}">{{ $order->code }}</a> --}}
                                {{ $order->code }}
                            </td>
                            <td>{{ $order->created_at }}</td>
                            <td>{{ $order->totalprice }}</td>
                            <td>
                                @if($order->transportstatus->name == 'ongoing')
                                <span class="text-primary ">{{ $order->transportstatus->detail }}</span>
                                @elseif($order->transportstatus->name == 'sending')
                                <span class="text-warning orange">{{ $order->transportstatus->detail }}</span>
                                @elseif($order->transportstatus->name == 'completed')
                                <span class="text-success green">{{ $order->transportstatus->detail }}</span>
                                @endif
                            </td>
                            <td>{{ $order->emscode }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="text-center">
                            <td colspan="7">
                                <button type="button" id="bt-print-muti" class="btn btn-info btn-lg  fa fa-print fa-lg"> พิมพ์ที่เลือก</button>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div> 
        </div>
    </div>
</div>
@endsection


@section('script')
<script type="text/javascript">
    $(document).ready(function(){

        checkBoxAll("#checkAll", ".check"); //function checkBoxAll custom.js

        // var tb_order = $("#tb-order").DataTable({
        //     sDom: '<"top"i>rt<"bottom"lp><"clear">',
        //     // responsive: true,
        //     order: [[3, "asc"]],
        //     columnDefs: [
        //     //{type: 'date-eu', targets: 6},
        //     {orderable: false, targets: 0}
        //     ],
        //     oLanguage: {
        //         "sLengthMenu": "แสดง _MENU_ เร็คคอร์ด ต่อหน้า",
        //         "sZeroRecords": "ไม่เจอข้อมูลที่ค้นหา",
        //         "sInfo": "แสดง _START_ ถึง _END_ ของ _TOTAL_ เร็คคอร์ด",
        //         "sInfoEmpty": "แสดง 0 ถึง 0 ของ 0 เร็คคอร์ด",
        //         "sInfoFiltered": "(จากเร็คคอร์ดทั้งหมด _MAX_ เร็คคอร์ด)",
        //         "sSearch": "ค้นหา :"
        //     }
        // });

        var tb_order = $('#tb-order').DataTable({
            order: [[3, "asc"]],
            columnDefs: [
            {orderable: false, targets: 0},
            {orderable: false, targets: 1}
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
