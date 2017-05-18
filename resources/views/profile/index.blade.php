@extends('layouts/main')

@section('content')
<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Profile</h2>
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
            <form enctype="multipart/form-data" id="edit-profile" method="POST" action="/profile/edit/{{$profile->id}}" class="form-horizontal">
                <div class="sub-menu-title">ข้อมูลทั่วไป</div>
                <div class="row">
                    {{ method_field('PUT') }}
                    {{ csrf_field() }}
                                {{-- <div class="col-xs-12 col-sm-3">
                                    <img id="avatar" class="editable img-responsive editable-click editable-empty" src="">

                                    <div class="space-6"></div>        
                                    <input type="file" name="files" id="id-input-file-2">
                                    <div class="space-12"></div> 

                                </div> --}}
                                <div class="col-xs-12 col-sm-8">
                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-2 control-label">ชื่อ-นามสกุล</label>
                                        <div class="col-sm-3">
                                            <input class="form-control" name="firstname" type="text" value="{{$profile->firstname}}" disabled />
                                        </div>
                                        <div class="col-sm-3">
                                            <input class="form-control" name="lastname" type="text" value="{{$profile->lastname}}" disabled />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="email" class="col-sm-2 control-label">อีเมลล์</label>
                                        <div class="col-sm-6">
                                            <input type="email" id="email" name="email" class="form-control input-large" value="{{$profile->email}}" data-bv-emailaddress-message="กรอกรูปแบบ Email : test@test.com">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                     <label for="tel" class="col-sm-2 control-label">เบอร์ติดต่อ</label>
                                     <div class="col-sm-4">
                                        <input class="form-control" id="tel" name="tel" maxlength="10" type="text" id="form-field-first" value="{{$profile->tel}}"/>
                                    </div>
                                    {{-- <div class="form-group">
                                        <label for="oldpass" class="col-sm-2 control-label">รหัสผ่านเก่า</label>
                                        <div class="col-sm-6">
                                            <input type="text" id="email" name="email" class="form-control input-large" value="{{$profile->email}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="col-sm-2 control-label">อีเมลล์</label>
                                        <div class="col-sm-6">
                                            <input type="text" id="email" name="email" class="form-control input-large" value="{{$profile->email}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="col-sm-2 control-label">อีเมลล์</label>
                                        <div class="col-sm-6">
                                            <input type="text" id="email" name="email" class="form-control input-large" value="{{$profile->email}}">
                                        </div>
                                    </div> --}}
                                    
                                </div>
                                <div class="col-sm-offset-2">
                                    <button class="btn btn-sm btn-primary" type="submit">
                                        <i class="fa fa-check"></i>
                                        บันทึก
                                    </button>
                                    <a class="btn btn-sm btn-default" href="/home">
                                        <i class="fa fa-reply"></i>
                                        กลับ
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </br>
                <div class="sub-menu-title">ข้อมูลที่อยู่ที่ใช้ในการสั่งสินค้า</div>
            </br>
            <div class="row">
                <div class="col-lg-10 col-centered">
                    <div class="tabbable">
                        <ul class="nav nav-tabs" id="myTab">
                           <li class="active">
                            <a data-toggle="tab" href="#addaddress">
                                เพิ่มที่จัดส่ง
                            </a>
                        </li>
                        @if(count($profile->address) > 0)
                        @foreach($profile->address as $address)
                        <li>
                            <a data-toggle="tab" href="#{{$address->id}}">
                                {{$address->fullname}}
                            </a>
                        </li>
                        @endforeach
                        @endif
                    </ul>
                </br>
                <div class="tab-content">
                    <div id="addaddress" class="tab-pane fade in active">
                        <form id="add-address" class="form-horizontal" method="POST" action="/address/add">
                            {{ csrf_field() }}
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
                        <div class="col-sm-offset-2">
                            <button class="btn btn-sm btn-primary" type="submit">
                                <i class="fa fa-check"></i>
                                บันทึก
                            </button>
                            <a class="btn btn-sm btn-default" href="/home">
                                <i class="fa fa-reply"></i>
                                กลับ
                            </a>
                        </div>
                    </form>
                </div>
                @if(count($profile->address) > 0)
                @foreach($profile->address as $address)
                <div id="{{$address->id}}" class="tab-pane fade">
                    <div class="col-sm-offset-2">
                        <button type="button" data-addressid="{{$address->id}}" class="btn btn-sm btn-danger bt-delete">
                            <i class="fa fa-trash"></i>
                            ลบที่อยู่
                        </button>
                    </div> 
                    <br>
                    <form class="form-horizontal edit-address" method="POST" action="/address/edit/{{$address->id}}">
                        {{ method_field('PUT') }}
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="fullname" class="col-sm-2 control-label">ชื่อในการจัดส่ง</label>
                            <div class="col-sm-6">
                                <input type="text" id="fullname" name="fullname" class="form-control" value="{{$address->fullname}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="detail" class="col-sm-2 control-label">ที่อยู่</label>
                            <div class="col-sm-6">
                                <textarea cols="5" rows="5" id="detail" name="detail" class="form-control">{{$address->detail}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="postcode" class="col-sm-2 control-label">รหัสไปรษณีย์</label>
                            <div class="col-sm-2">
                                <input type="text" id="postcode" name="postcode" maxlength="5" class="form-control" value="{{$address->postcode}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tel" class="col-sm-2 control-label">เบอร์ติดต่อ</label>
                            <div class="col-sm-4">
                                <input class="form-control" id="tel" name="tel" type="text" maxlength="10" id="form-field-first" value="{{$address->tel}}"/>
                            </div>
                        </div>
                        <div class="col-sm-offset-2">
                            <button class="btn btn-sm btn-warning" type="submit">
                                <i class="fa fa-pencil"></i>
                                แก้ไข
                            </button>
                            <a class="btn btn-sm btn-default" href="/home">
                                <i class="fa fa-reply"></i>
                                กลับ
                            </a>
                        </div> 
                    </form>
                </div>
                @endforeach
                @endif
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
        $('#add-address').bootstrapValidator({
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
                    message: 'กรอกเป็นตัวเลข'
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

$('.edit-address').bootstrapValidator({
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
                    message: 'กรอกเป็นตัวเลข'
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
                type: "PUT",
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

$('#edit-profile').bootstrapValidator({
    framework: 'bootstrap',
    fields: {
        email: {
            validators: {
                notEmpty: {
                    message: 'กรุณากรอก Email'
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
                type: "PUT",
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

$(document).on('click', '.bt-delete', function () {

    var r = confirm("คุณต้องการลบรายการที่เลือก");
    if (r === true) {
        var addressId = $(this).data("addressid");
        var get = $.get("/address/delete/"+addressId);
        get.done(function ($data) {
            console.log($data);
            if ($data.status === 200) {
                location.reload(true);
            }
        });
    }
});
});
</script>
@endsection
