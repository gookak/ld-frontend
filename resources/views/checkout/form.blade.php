@extends('layouts/main')

@section('content')
<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>ยืนยันสินค้าที่สั่งซื้อ</h2>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End Page title area -->

<div class="single-product-area">
    <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="clearfix">
                        <div id="msgErrorArea"></div>
                    </div>
                    <form id="add-order" class="form-horizontal" method="POST" action="/checkout/add">
                        <div class="col-sm-offset-3 sub-menu-title">ที่อยู่จัดส่ง</div>
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
                            <label for="fullname" class="col-sm-3 control-label">ชื่อในการจัดส่ง*</label>
                            <div class="col-sm-6">
                                <input type="text" id="fullname" name="fullname" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="detail" class="col-sm-3 control-label">ที่อยู่*</label>
                            <div class="col-sm-6">
                                <textarea cols="5" rows="5" id="detail" name="detail" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="postcode" class="col-sm-3 control-label">รหัสไปรษณีย์*</label>
                            <div class="col-sm-4">
                                <input type="text" id="postcode" name="postcode" maxlength="5" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tel" class="col-sm-3 control-label">เบอร์ติดต่อ*</label>
                            <div class="col-sm-4">
                                <input class="form-control" maxlength="10" id="tel" name="tel" type="text"/>
                            </div>
                        </div>
                        </br>
                        <div class="col-sm-offset-3">
                        @if(Session::has('cart'))
                            <button class="btn btn-lg btn-primary" type="submit">
                                <i class="fa fa-check"></i>
                                บันทึก
                            </button>
                            {{-- <a href="" class="pdforder hide" target="_blank">test</a> --}}
                        @endif
                            <a class="btn btn-lg btn-default" href="/cart">
                                <i class="fa fa-reply"></i>
                                กลับ
                            </a>
                        </div>
                    </form>
                </div>
            </div>
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
                ,stringLength: {
                    min: 10,
                    max: 10,
                    message: 'กรอกเบอร์โทรอย่างน้อย 10 ตัว'
                },
                numeric: {
                    message: 'กรอกเป็นตัวเลข'
                },
                callback: {
                    message: 'รูปแบบ 0812345678',
                    callback: function (value, validator, $field) {
                        return value.substring(0,2) == 08 || value.substring(0,2) == 06 || value.substring(0,2) == 09;
                    }
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
                async: false,
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
                    // $('.pdforder').attr("href", "order/"+data.orderId+"/pdf");
                    // var link = $('.pdforder');
                    // console.log(link);
                    // link.click();
                    window.open('order/'+data.orderId+'/pdf' , '_blank');
                    window.location = data.url;
                }
            }).fail(function () {
                showMsgError("#msgErrorArea", data.msgerror);
            });
        });
});
</script>
@endsection
