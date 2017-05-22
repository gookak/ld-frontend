@extends('layouts/main')


@section('content')
<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>วิธีสั่งซื้อ</h2>
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
                <div class="sub-menu-title"><h1>การสมัครสมาชิก หรือ เข้าสู่ระบบ</h1></div></br>
                <p><h3>ลูกค้าสามารถสมัครสมาชิก หรือเข้าสู่ระบบ เพื่อ สั่งซื้อสินค้ากับ L&D Com ได้จากเมนูด้านขวาบนของเว็บไซต์</h3></p></br>
                <div class="img-howto ace-thumbnails clearfix">
                    <a href="{{ asset('howto/login.png' )}}" data-rel="colorbox">
                        <img src="{{ asset('howto/login.png' )}}" class="img-rounded img-thumbnail">
                    </a>
                </div>
                </br>
                <div class="img-howto ace-thumbnails clearfix">
                    <a href="{{ asset('howto/login1.png' )}}" data-rel="colorbox">
                        <img src="{{ asset('howto/login1.png' )}}" class="img-rounded img-thumbnail">
                    </a>
                </div>
                </br>
                <div class="sub-menu-title"><h1>การสมัครสมาชิก</h1></div></br>
                <p><h3>กรอกข้อมูลให้ครบถ้วน</h3></p></br>
                <div class="img-howto ace-thumbnails clearfix">
                    <a href="{{  asset('howto/register.png' )}}" data-rel="colorbox">
                        <img src="{{ asset('howto/register.png' )}}" class="img-rounded img-thumbnail">
                    </a>
                </div>
                </br>
                <div class="sub-menu-title"><h1>การเลือกสินค้า</h1></div></br>
                <p><h3>1. ลูกค้าสามารถเลือกสินค้าได้จากเมนู สินค้า โดยกดปุ่ม เลือกสินค้า หรือ ปุ่มรายละเอียด เพื่อดูรายละเอียดสินค้า</h3></p>
                </br>
                <div class="img-howto ace-thumbnails clearfix">
                    <a href="{{ asset('howto/product.png' )}}" data-rel="colorbox">
                        <img src="{{ asset('howto/product.png' )}}" class="img-rounded img-thumbnail">
                    </a>
                </div>
                </br>
                <div class="img-howto ace-thumbnails clearfix">
                    <a href="{{ asset('howto/detail.png' )}}" data-rel="colorbox">
                        <img src="{{ asset('howto/detail.png' )}}" class="img-rounded img-thumbnail">
                    </a>
                </div>
                </br>
                <p><h3>2. ลูกค้าสามารถดูรายสินค้าที่เลือกได้จากเมนู ตระกร้า </h3></p>
                <p><h3>3. ลูกค้าสามารถกดปุ่มเลือกสินค้าเพิ่ม เพื่อเลือกสินค้าต่อ หรือ กดปุ่มยืนยันสินค้าที่สั่งซื้อ เมื่อเลือกสินค้าที่ต้องการซื้อเรียบร้อย</h3></p>
                </br>
                <div class="img-howto ace-thumbnails clearfix">
                    <a href="{{ asset('howto/cart.png' )}}" data-rel="colorbox">
                        <img src="{{ asset('howto/cart.png' )}}" class="img-rounded img-thumbnail">
                    </a>
                </div>
                </br>
                <div class="sub-menu-title"><h1>กำหนดที่อยู่จัดส่ง</h1></div></br>
                <p><h3>หลังจากลูกค้าเลือกซื้อสินค้าเรียบร้อยแล้ว ลูกค้าสามารถเพิ่มที่อยู่จัดส่ง หรือ เลือกที่อยู่ที่มีอยู่แล้ว และกดบันทึก พิมพ์ใบสั่งซื้อเก้บไว้เป็นหลักฐาน</h3></p>
                </br>
                <div class="img-howto ace-thumbnails clearfix">
                    <a href="{{ asset('howto/checkout.png' )}}" data-rel="colorbox">
                        <img src="{{ asset('howto/checkout.png' )}}" class="img-rounded img-thumbnail">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



@section('script')
<script type="text/javascript">
    $(document).ready(function(){
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