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
            <div class="col-md-12 text-center">
                <div class="sub-menu-title"><h1>1. การสมัครสมาชิก หรือ เข้าสู่ระบบ เพื่อสั่งซื้อสินค้า</h1></div></br>
                <p><h4>ลูกค้าสามารถสมัครสมาชิก หรือเข้าสู่ระบบ เพื่อ สั่งซื้อสินค้ากับ L&D Com ได้จากเมนูด้านขวาบนของเว็บไซต์</h4></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <div class="img-howto ace-thumbnails clearfix">
                    <a href="{{ asset('howto/login.png' )}}" data-rel="colorbox">
                        <img src="{{ asset('howto/login.png' )}}" class="img-responsive img-rounded img-thumbnail">
                    </a>
                </div>
            </div>
        </div>
        <br>
        <br>
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="sub-menu-title"><h3>1.1 เข้าสู่ระบบ</h3></div></br>
                <p><h4>กรอก อีเมล์ และ รหัสผ่านให้ถูกต้อง แล้วกดปุ่มเข้าสู่ระบบ</h4></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <div class="img-howto ace-thumbnails clearfix">
                    <a href="{{ asset('howto/login1.png' )}}" data-rel="colorbox">
                        <img src="{{ asset('howto/login1.png' )}}" class="img-responsive img-rounded img-thumbnail">
                    </a>
                </div>
            </div>
        </div>
        <br>
        <br>
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="sub-menu-title"><h3>1.2 การสมัครสมาชิก</h3></div></br>
                <p><h4>กรอกข้อมูลให้ครบถ้วน แล้วกดปุ่มสมัครสมาชิก</h4></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <div class="img-howto ace-thumbnails clearfix">
                    <a href="{{  asset('howto/register.png' )}}" data-rel="colorbox">
                        <img src="{{ asset('howto/register.png' )}}" class="img-responsive img-rounded img-thumbnail">
                    </a>
                </div>
            </div>
        </div>
        <br>
        <br>
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="sub-menu-title"><h1>2 การสั่งซื้อสินค้า</h1></div></br>
                <div class="sub-menu-title"><h3>2.1 การเลือกสินค้าหน้าสินค้า</h3></div></br>
                <p><h4>ลูกค้าสามารถดูสินค้าจากร้าน L&D Com ได้โดยการเข้าเมนู สินค้า และสามารถเลือกสินค้าได้โดยการกดปุ่ม เลือกสินค้า หรือ ปุ่มรายละเอียด เพื่อดูรายละเอียดสินค้า</h4></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <div class="img-howto ace-thumbnails clearfix">
                    <a href="{{ asset('howto/product.png' )}}" data-rel="colorbox">
                        <img src="{{ asset('howto/product.png' )}}" class="img-responsive img-rounded img-thumbnail">
                    </a>
                </div>
            </div>
        </div>
        <br>
        <br>
        <div class="row">
            <div class="col-md-12 text-center">        
                <div class="sub-menu-title"><h3>2.2 การเลือกสินค้าหน้ารายละเอียดสินค้า</h3></div></br>
                <p><h4>ลูกค้าสามารถดูรายละเอียดของสินค้าที่ต้องการสั่งซื้อได้จากหน้านี้ และสามารถเลือกสินค้าได้โดยการกดปุ่ม เลือกสินค้า (เปลี่ยนจำนวนได้)</h4></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <div class="img-howto ace-thumbnails clearfix">
                    <a href="{{ asset('howto/detail.png' )}}" data-rel="colorbox">
                        <img src="{{ asset('howto/detail.png' )}}" class="img-responsive img-rounded img-thumbnail">
                    </a>
                </div>
            </div>
        </div>
        <br>
        <br>
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="sub-menu-title"><h3>2.3 การดูสินค้าที่เลือกซื้อ</h3></div></br>
                <p><h4>ลูกค้าสามารถดูรายสินค้าที่เลือกได้จากเมนู ตระกร้า และ สามารถ เพิ่ม ลด หรือ ลบ สินค้าที่เลือกได้ โดยการกดปุ่มในกรอบสีเขียว </h4></p>
                <p><h4>ถ้าลูกค้าต้องการเลือกสินค้าเพิมสามารถกดปุ่มเลือกสินค้าเพิ่ม เพื่อเลือกสินค้าต่อ 
                    หรือ กดปุ่มยืนยันสินค้าที่สั่งซื้อ เมื่อเลือกสินค้าที่ต้องการซื้อเรียบร้อย</h4></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <div class="img-howto ace-thumbnails clearfix">
                    <a href="{{ asset('howto/cart.png' )}}" data-rel="colorbox">
                        <img src="{{ asset('howto/cart.png' )}}" class="img-responsive img-rounded img-thumbnail">
                    </a>
                </div>
            </div>
        </div>
        <br>
        <br>
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="sub-menu-title"><h1>3. การยืนยันการสั่งซื้อสินค้า</h1></div></br>
                <p><h4>หลังจากลูกค้าเลือกซื้อสินค้าเรียบร้อยแล้ว กดปุ่มยืนยันสินค้าที่สั่งซื้อ ระบบจำนำทางมายังหน้า ยืนยันสินค้าที่สั่งซื้อ</h4></p>
                <p><h4>ให้ลูกค้ากรอกที่อยู่ที่ใช้ในการจัดส่งสินค้า หรือ เลือกที่อยู่ที่มีอยู่แล้ว และกดบันทึก พิมพ์ใบสั่งซื้อเก็บไว้เป็นหลักฐาน</h4></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <div class="img-howto ace-thumbnails clearfix">
                    <a href="{{ asset('howto/checkout.png' )}}" data-rel="colorbox">
                        <img src="{{ asset('howto/checkout.png' )}}" class="img-responsive img-rounded img-thumbnail">
                    </a>
                </div>
            </div>
        </div>
        <br>
        <br>
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <div class="img-howto ace-thumbnails clearfix">
                    <a href="{{ asset('howto/checkout2.png' )}}" data-rel="colorbox">
                        <img src="{{ asset('howto/checkout2.png' )}}" class="img-responsive img-rounded img-thumbnail">
                    </a>
                </div>
            </div>
        </div>
        <br>
        <br>
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <div class="img-howto ace-thumbnails clearfix">
                    <a href="{{ asset('howto/pdf.png' )}}" data-rel="colorbox">
                        <img src="{{ asset('howto/pdf.png' )}}" class="img-responsive img-rounded img-thumbnail">
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