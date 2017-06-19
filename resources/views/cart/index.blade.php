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
                    <h2>รายการสินค้าที่สั่งซื้อ</h2>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End Page title area -->


<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-content-right">
                    <div class="woocommerce">
                        <form method="post" class="shop_form" action="#">
                                <table id="tb-cart" cellspacing="0" class="table table-striped table-bordered table-hover responsive nowrap shop_table cart">
                                <thead>
                                    <tr>
                                        <th class="product-remove">&nbsp;</th>
                                        <th class="product-thumbnail">&nbsp;</th>
                                        <th class="product-name">สินค้า</th>
                                        <th class="product-price">ราคาต่อชิ้น</th>
                                        <th class="product-quantity">จำนวน</th>
                                        <th class="product-subtotal">ราคารวม</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(Session::has('cart'))
                                    @foreach($products as $product)
                                    <tr class="cart_item">
                                        <td class="product-remove">
                                            <button type="button" class="btn btn-xs btn-danger removeItem" data-productid="{{$product['item']['id']}}"><i class="fa fa-times"></i></button> 
                                        </td>
                                        <td class="product-thumbnail">
                                            <div class="ace-thumbnails clearfix">
                                                @if($product['image'])
                                                <a href="{{ asset(env('FILE_URL').$product['image'])}}" data-rel="colorbox">
                                                    <img class="img-responsive" src="{{ asset(env('FILE_URL').$product['image'])}}">
                                                </a>
                                                @else
                                                <a href="{{ asset(env('FILE_URL')."noimage.jpg" )}}" data-rel="colorbox">
                                                    <img class="img-responsive" src="{{ asset(env('FILE_URL')."noimage.jpg" )}}">
                                                </a>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="product-name">
                                            <a target="_blank" href="/productDetail/{{$product['item']['id']}}">{{$product['item']['name']}}</a> 
                                        </td>

                                        <td class="product-price">
                                            <span class="amount">{{number_format($product['item']['price'],2)}} บาท</span> 
                                        </td>

                                        <td class="product-quantity">
                                            <div class="quantity buttons_added">
                                                <button type="button" class="btn btn-xs btn-primary minusItem" data-productid="{{$product['item']['id']}}"><i class="fa fa-minus"></i></button> 
                                                <input type="text" readonly size="1" class="input-text qty text" title="Qty" value="{{$product['qty']}}">
                                                @if($product['item']['balance'] > $product['qty'])
                                                    <button type="button" class="btn btn-xs btn-primary plusItem" data-productid="{{$product['item']['id']}}"><i class="fa fa-plus"></i></button> 
                                                @endif
                                            </div>
                                        </td>

                                        <td class="product-subtotal">
                                            <span class="amount">{{number_format($product['price'],2)}} บาท</span> 
                                        </td>
                                    </tr>
                                    @endforeach
                                    {{-- @else
                                    <tr><td colspan="6">ไม่มีข้อมูล</td></tr> --}}
                                    @endif
                                    {{-- <tr>
                                        <td class="actions" colspan="6">
                                            <a class="btn btn-lg btn-primary" href="/product">
                                                <i class="fa fa-check"></i>
                                                ยืนยันสินค้าที่สั่งซื้อ
                                            </a>&nbsp;&nbsp;
                                            <a class="btn btn-lg btn-default" href="/product">
                                                <i class="fa fa-reply"></i>
                                                เลือกสินค้าเพิ่ม
                                            </a>
                                        </td>
                                    </tr> --}}
                                </tbody>
                            </table>
                            
                        </form>
                    
                        <div class="cart-collaterals">
                            <div class="row shop_total">
                                </br>
                                <div class="col-md-8 ">
                                    <div class="text-center">
                                        @if(Session::has('cart'))
                                            <a class="btn btn-lg btn-primary" href="/checkout">
                                                <i class="fa fa-check"></i>
                                                ยืนยันสินค้าที่สั่งซื้อ
                                            </a>&nbsp;&nbsp;
                                        @endif
                                        <a class="btn btn-lg btn-default" href="/product">
                                            <i class="fa fa-reply"></i>
                                            เลือกสินค้าเพิ่ม
                                        </a>
                                        {{-- <h2><a href="#checkout" class="check_out"><span>ยืนยันสินค้าที่สั่งซื้อ</span></a></h2> --}}
                                    </div>
                                    </br>
                                </div>
                                <div class="col-md-4 cart_totals">
                                    <h2>สรุปรายการสินค้า</h2>

                                    <table cellspacing="0">
                                        <tbody>
                                            <tr class="cart-subtotal">
                                                <th>จำนวนสินค้าทั้งหมด</th>
                                                <td><span class="amount">{{$totalQty}}</span></td>
                                            </tr>

                                            <tr class="order-total">
                                                <th>ราคาสุทธิ</th>
                                                <td><strong><span class="amount">{{number_format($totalPrice,2)}} บาท</span></strong> </td>
                                            </tr>
                                            <tr class="order-total">
                                                <th></th>
                                                <td><strong><span class="amount">{{$totalPriceThai}}</span></strong> </td>
                                            </tr>
                                        </tbody>
                                    </table>
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

        $('img').error(function () {
            $(this).attr({
                src: "{{ asset(env('FILE_URL')."noimage.jpg" )}}"
            });
            $(this).parent("a").attr({
                href: "{{ asset(env('FILE_URL')."noimage.jpg" )}}"
            });
        });

        var tb_cart = $('#tb-cart').DataTable({
            searching: false,
            lengthChange: false,
            order: [[2, "desc"]],
            columnDefs: [
            {orderable: false, targets: 0},
            {orderable: false, targets: 1}
            ],
            iDisplayLength: 10,
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

        $(".woocommerce").on("click",".minusItem",function(){
            var productId = $(this).data("productid");
            $.get("/cart/reduceProduct/"+productId,function(data){
                // $(".cart-reload").load("/product .shopping-item");
                $("form.shop_form").load("/cart table.shop_table", function (response, status, xhr) {
                    var tb_cart = $('#tb-cart').DataTable({
                        searching: false,
                        lengthChange: false,
                        order: [[2, "desc"]],
                        columnDefs: [
                        {orderable: false, targets: 0},
                        {orderable: false, targets: 1}
                        ],
                        iDisplayLength: 10,
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
                $(".cart-collaterals").load("/cart .shop_total");
                $(".shoppingcart").load("/cart span.cart-item");
            });

        });

        $(".woocommerce").on("click",".removeItem",function(){
            var productId = $(this).data("productid");
            $.get("/cart/removeItem/"+productId,function(data){
                // $(".cart-reload").load("/product .shopping-item");
                $("form.shop_form").load("/cart table.shop_table", function (response, status, xhr) {
                    var tb_cart = $('#tb-cart').DataTable({
                        searching: false,
                        lengthChange: false,
                        order: [[2, "desc"]],
                        columnDefs: [
                        {orderable: false, targets: 0},
                        {orderable: false, targets: 1}
                        ],
                        iDisplayLength: 10,
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
                $(".cart-collaterals").load("/cart .shop_total");
                $(".shoppingcart").load("/cart span.cart-item");
            });

        });

        $(".woocommerce").on("click",".plusItem",function(){
            var productId = $(this).data("productid");
            $.get("/cart/plusProduct/"+productId,function(data){
                // $(".cart-reload").load("/product .shopping-item");
                $("form.shop_form").load("/cart table.shop_table", function (response, status, xhr) {
                    var tb_cart = $('#tb-cart').DataTable({
                        searching: false,
                        lengthChange: false,
                        order: [[2, "desc"]],
                        columnDefs: [
                        {orderable: false, targets: 0},
                        {orderable: false, targets: 1}
                        ],
                        iDisplayLength: 10,
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
                $(".cart-collaterals").load("/cart .shop_total");
                $(".shoppingcart").load("/cart span.cart-item");
            });

        });

        var $overflow = '';
        var colorbox_params = {
            rel: 'colorbox',
            reposition:true,
            scalePhotos:true,
            scrolling:false,
            previous:'<i class="ace-icon fa fa-arrow-left"></i>',
            next:'<i class="ace-icon fa fa-arrow-right"></i>',
            close:'&times;',
            current:'{current} of {total}',
            maxWidth:'100%',
            maxHeight:'100%',
            onOpen:function(){
                $overflow = document.body.style.overflow;
                document.body.style.overflow = 'hidden';
            },
            onClosed:function(){
                document.body.style.overflow = $overflow;
            },
            onComplete:function(){
                $.colorbox.resize();
            }
        };

        $('.ace-thumbnails [data-rel="colorbox"]').colorbox(colorbox_params);
    $("#cboxLoadingGraphic").html("<i class='ace-icon fa fa-spinner orange fa-spin'></i>");//let's add a custom loading icon
    
    
    $(document).one('ajaxloadstart.page', function(e) {
        $('#colorbox, #cboxOverlay').remove();
    });
});
</script>
@endsection
