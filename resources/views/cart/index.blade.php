@extends('layouts/main')

@section('content')
<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Shopping Cart</h2>
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
                            <table cellspacing="0" class="shop_table cart">
                                <thead>
                                    <tr>
                                        <th class="product-remove">&nbsp;</th>
                                        <th class="product-thumbnail">&nbsp;</th>
                                        <th class="product-name">Product</th>
                                        <th class="product-price">Price</th>
                                        <th class="product-quantity">Quantity</th>
                                        <th class="product-subtotal">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(Session::has('cart'))
                                    {{-- @if(Cookie::get('cart')) --}}
                                    @foreach($products as $product)
                                    <tr class="cart_item">
                                        <td class="product-remove">
                                            <button type="button" class="btn btn-xs btn-danger removeItem" data-productid="{{$product['item']['id']}}"><i class="fa fa-times"></i></button> 
                                        </td>
                                        <td class="product-thumbnail">
                                            <div class="product-gallery ace-thumbnails clearfix">
                                                @if($product['image'])
                                                    <a href="{{ asset(env('FILE_URL').$product['image'])}}" data-rel="colorbox">
                                                        <img width="145" height="145" src="{{ asset(env('FILE_URL').$product['image'])}}">
                                                    </a>
                                                @else
                                                    <a href="{{ asset(env('FILE_URL')."noimage.jpg" )}}" data-rel="colorbox">
                                                        <img src="{{ asset(env('FILE_URL')."noimage.jpg" )}}">
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="product-name">
                                            <a target="_blank" href="/productDetail/{{$product['item']['id']}}">{{$product['item']['name']}}</a> 
                                        </td>

                                        <td class="product-price">
                                            <span class="amount">{{$product['item']['price']}}</span> 
                                        </td>

                                        <td class="product-quantity">
                                            <div class="quantity buttons_added">
                                                <button type="button" class="btn btn-xs btn-primary minusItem" data-productid="{{$product['item']['id']}}"><i class="fa fa-minus"></i></button> 
                                                <input type="text" readonly size="1" class="input-text qty text" title="Qty" value="{{$product['qty']}}">
                                                <button type="button" class="btn btn-xs btn-primary plusItem" data-productid="{{$product['item']['id']}}"><i class="fa fa-plus"></i></button> 
                                            </div>
                                        </td>

                                        <td class="product-subtotal">
                                            <span class="amount">{{$product['price']}}</span> 
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr><td colspan="6">ไม่มีข้อมูล</td></tr>
                                    @endif
                                    {{-- <tr>
                                        <td class="actions" colspan="6">
                                            <input type="submit" value="Update Cart" name="update_cart" class="button">
                                            <input type="submit" value="Checkout" name="proceed" class="checkout-button button alt wc-forward">
                                        </td>
                                    </tr> --}}
                                </tbody>
                            </table>
                        </form>

                        <div class="cart-collaterals">
                            <div class="row">
                                <div class="col-md-4 cart_totals">
                                    <div class="shop_total">
                                        <h2>Cart Totals</h2>

                                        <table cellspacing="0">
                                            <tbody>
                                                <tr class="cart-subtotal">
                                                    <th>Order Total</th>
                                                    <td><span class="amount">{{$totalQty}}</span></td>
                                                </tr>

                                                <tr class="order-total">
                                                    <th>Total Price</th>
                                                    <td><strong><span class="amount">{{$totalPrice}}</span></strong> </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                @if(Session::has('cart') && Auth::user())
                                <div class="col-md-8 ">
                                    <div class="text-center">
                                        <h2><a data-toggle="collapse" href="#check_out" aria-expanded="false" aria-controls="check_out">Check out</a></h2>
                                    </div>
                                    
                                    {{-- <h2><a href="/checkout" name="checkout" class="btn btn-primary">Check out</a></h2> --}}
                                    <div id="check_out" class="row collapse">
                                        <div class="col-xs-12">
                                            <div class="clearfix">
                                                <div id="msgErrorArea"></div>
                                            </div>
                                            <form id="add-order" class="form-horizontal" method="POST" action="/checkout/add">
                                                <div class="col-sm-offset-3 sub-menu-title">การจัดส่ง</div>
                                                <br>
                                                {{ csrf_field() }}
                                                @if(count($profile->address) > 0)
                                                <div class="form-group">
                                                    <label for="address" class="col-sm-3 control-label">ที่อยู่ในการจัดส่ง</label>
                                                    <div class="col-sm-4">
                                                        <select id="address" class="form-control address">
                                                            <option value="">เลือกที่อยู่</option>
                                                            @foreach($profile->address as $address)
                                                            <option value="{{$address->id}}">{{$address->fullname}}</option>
                                                            @endforeach
                                                            <option value="">ที่อยู่อื่น</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                @endif
                                            </br>
                                            <input type="hidden" name="addressid">
                                            <div class="form-group">
                                                <label for="fullname" class="col-sm-3 control-label">ชื่อในการจัดส่ง</label>
                                                <div class="col-sm-6">
                                                    <input type="text" id="fullname" name="fullname" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="detail" class="col-sm-3 control-label">ที่อยู่</label>
                                                <div class="col-sm-6">
                                                 <textarea cols="5" rows="5" id="detail" name="detail" class="form-control"></textarea>
                                             </div>
                                         </div>
                                         <div class="form-group">
                                            <label for="postcode" class="col-sm-3 control-label">รหัสไปรษณีย์</label>
                                            <div class="col-sm-4">
                                             <input type="text" id="postcode" name="postcode" maxlength="5" class="form-control">
                                         </div>
                                     </div>
                                     <div class="form-group">
                                        <label for="tel" class="col-sm-3 control-label">เบอร์ติดต่อ</label>
                                        <div class="col-sm-4">
                                            <input class="form-control" id="tel" name="tel" type="text"/>
                                        </div>
                                    </div>
                                </br>
                                <div class="col-sm-offset-3">
                                    <button class="btn btn-lg btn-primary" type="submit">
                                        <i class="ace-icon fa fa-check bigger-110"></i>
                                        บันทึก
                                    </button>
                                    <a class="btn btn-lg btn-default" href="/product">
                                        <i class="ace-icon fa fa-reply bigger-110"></i>
                                        เลือกสินค้าเพิ่ม
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endif
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

        $(".woocommerce").on("click",".minusItem",function(){
            var productId = $(this).data("productid");
            $.get("/cart/reduceProduct/"+productId,function(data){
                // $(".cart-reload").load("/product .shopping-item");
                $("form.shop_form").load("/cart table.shop_table");
                $(".cart_totals").load("/cart .shop_total");
                $(".shoppingcart").load("/cart span.cart-item");
            });

        });

        $(".woocommerce").on("click",".removeItem",function(){
            var productId = $(this).data("productid");
            $.get("/cart/removeItem/"+productId,function(data){
                // $(".cart-reload").load("/product .shopping-item");
                $("form.shop_form").load("/cart table.shop_table");
                $(".cart_totals").load("/cart .shop_total");
                $(".shoppingcart").load("/cart span.cart-item");
            });

        });

        $(".woocommerce").on("click",".plusItem",function(){
            var productId = $(this).data("productid");
            $.get("/cart/plusProduct/"+productId,function(data){
                // $(".cart-reload").load("/product .shopping-item");
                $("form.shop_form").load("/cart table.shop_table");
                $(".cart_totals").load("/cart .shop_total");
                $(".shoppingcart").load("/cart span.cart-item");
            });

        });

        $(document).on("change",".address",function(){
            var addressId = $(this).val();
            if(addressId ){
                var jqxhr = $.ajax({
                    type: "GET",
                    url: "/address/get",
                    data: {"addressId": addressId},
                    dataType: 'JSON',
                }).done(function (data) {
                    $("input[name=addressid]").val(data.address.id);
                    $("input[name=fullname]").val(data.address.fullname).prop('readonly', true);
                    $("textarea[name=detail]").val(data.address.detail).prop('readonly', true);
                    $("input[name=postcode]").val(data.address.postcode).prop('readonly', true);
                    $("input[name=tel]").val(data.address.tel).prop('readonly', true);
                });
            }else{
                $("input[name=addressid]").val("");
                $("input[name=fullname]").val("").prop('readonly', false);
                $("textarea[name=detail]").val("").prop('readonly', false);
                $("input[name=postcode]").val("").prop('readonly', false);
                $("input[name=tel]").val("").prop('readonly', false);
            }
        });

        $('#add-order').bootstrapValidator({
            framework: 'bootstrap',
            fields: {
                fullname: {
                    validators: {
                        notEmpty: {
                            message: 'กรุณากรอกชื่อในการส่ง'
                        }
                    }
                },
                detail: {
                    validators: {
                     notEmpty: {
                        message: 'กรุณากรอกที่อยู่'
                    }
                }
            },
            postcode: {
                validators: {
                   notEmpty: {
                    message: 'กรุณากรอกรหัสไปรษณีย์'
                },
                stringLength: {
                    min: 5,
                    max: 5,
                    message: 'กรอกรหัสไปรษณีย์อย่างน้อย 5 ตัว'
                },
                integer: {
                    message: 'กรอกเป็นตัวเลข'
                }
            }
        },
        tel: {
            validators: {
                notEmpty: {
                    message: 'กรุณากรอกเบอร์โทร'
                }
            }
        }
    }
}).on('success.field.bv', function(e, data) {
            // e, data parameters are the same as in error.field.bv event handler
            // Despite that the field is valid, by default, the submit button will be disabled if all the following conditions meet
            // - The submit button is clicked
            // - The form is invalid
            data.bv.disableSubmitButtons(false);
        }).on("success.form.bv", function (e) {
            // Prevent form submission
            e.preventDefault();
            // Get the form instance
            var $form = $(e.target);
            console.log($form);
            
            var formdata = $form.serializeArray();
            console.log($form.attr('action'));

            var jqxhr = $.ajax({
                type: "POST",
                url: $form.attr('action'),
                data: formdata,
                dataType: 'JSON',
            }).done(function (data) {
                console.log(data);
                if (data.status == 501) {
                    showMsgError("#msgErrorArea", data.msgerror);
                    // $('#add-order').bootstrapValidator("resetForm",true);
                    // $("input[name=addressid]").val("");
                    // $("input[name=fullname]").prop('readonly', false);
                    // $("textarea[name=detail]").prop('readonly', false);
                    // $("input[name=postcode]").prop('readonly', false);
                    // $("input[name=tel]").prop('readonly', false); 
                } else if (data.status !== 200)  {
                    showMsgError("#msgErrorArea", data.msgerror);
                } else {
                    window.location = data.url;
                }
            }).fail(function () {
                showMsgError("#msgErrorArea", data.msgerror);
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
