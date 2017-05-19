@extends('layouts/main')

@section('content')
<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Check Out</h2>
                </div>
            </div>
        </div>
    </div>
</div>
</br>
<div class="row">
    <div class="col-xs-12">
        <div class="clearfix">
            <div id="msgErrorArea"></div>
        </div>
        <div class="col-lg-12 col-centered">
            <form id="add-order" class="form-horizontal" method="POST" action="">
                <div class="col-sm-offset-2 sub-menu-title">การจัดส่ง</div>
                <br>
                {{ csrf_field() }}
                @if(count($profile->address) > 0)
                    <div class="form-group">
                        <label for="address" class="col-sm-2 control-label">ที่อยู่ในการจัดส่ง</label>
                        <div class="col-sm-3">
                            <select id="address" class="form-control address">
                                <option value="">เลือกที่อยู่</option>
                                @foreach($profile->address as $address)
                                <option value="{{$address->id}}">address {{$address->id}}</option>
                                @endforeach
                                <option value="">ที่อยู่อื่น</option>
                            </select>
                        </div>
                    </div>
                @endif
                </br>
                <input type="hidden" name="addressid">
                <div class="form-group">
                    <label for="fullname" class="col-sm-2 control-label">ชื่อในการจัดส่ง</label>
                    <div class="col-sm-6">
                        <input type="text" id="fullname" name="fullname" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="detail" class="col-sm-2 control-label">ที่อยู่</label>
                    <div class="col-sm-6">
                       <textarea cols="5" rows="5" id="detail" name="detail" class="form-control"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="postcode" class="col-sm-2 control-label">รหัสไปรษณีย์</label>
                    <div class="col-sm-2">
                       <input type="text" id="postcode" name="postcode" maxlength="5" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="tel" class="col-sm-2 control-label">เบอร์ติดต่อ</label>
                    <div class="col-sm-4">
                        <input class="form-control" id="tel" name="tel" maxlength="10" type="text"/>
                    </div>
                </div>
                </br>
                <div class="row"> 
                    <div class="col-sm-offset-1 col-sm-10">
                        <h3 id="order_review_heading">Your order</h3>

                        <div id="order_review" style="position: relative;">
                            <table class="shop_table">
                                <thead>
                                    <tr>
                                        <th class="product-name">Product</th>
                                        <th class="product-total">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $product)
                                    <tr class="cart_item">
                                        <td class="product-name">{{$product['item']['name']}} <strong class="product-quantity">× {{$product['qty']}}</strong> </td>
                                        <td class="product-total">
                                            <span class="amount">{{$product['price']}}</span> </td>
                                        </tr>
                                        @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="cart-subtotal">
                                        <th>Order Subtotal</th>
                                        <td><span class="amount">{{$totalQty}}</span>
                                        </td>
                                    </tr>
                                    <tr class="order-total">
                                        <th>Total Price</th>
                                        <td><strong><span class="amount">{{$totalPrice}}</span></strong> </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-sm-offset-3">
                    <button class="btn btn-lg btn-primary" type="submit">
                        <i class="ace-icon fa fa-check bigger-110"></i>
                        บันทึก
                    </button>
                    <a class="btn btn-lg btn-default" href="/home">
                        <i class="ace-icon fa fa-reply bigger-110"></i>
                        ยกเลิก
                    </a>
                </div>
            </form>
            </br>
        </div>
    </div>
</div>
@endsection


@section('script')
<script type="text/javascript">
    $(document).ready(function(){

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
                        numberic: {
                            numberic: 'กรอกเป็นตัวเลข'
                        }
                    }
                },
                tel: {
                    validators: {
                        notEmpty: {
                            message: 'กรุณากรอกเบอร์โทร'
                        },
                        stringLength: {
                            min: 9,
                            max: 10,
                            message: 'กรอกเบอร์โทรอย่างน้อย 9 ตัว'
                        },
                        numberic: {
                            message: 'กรอกเป็นตัวเลข'
                        }
                    }
                }
            }
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
                if (data.status !== 200) {
                    showMsgError("#msgErrorArea", data.msgerror);
                } else {
                    window.location = data.url;
                }
            }).fail(function () {
                showMsgError("#msgErrorArea", data.msgerror);
            });
        });
    });
</script>
@endsection