@extends('layouts/main')

@section('content')
    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>ข้อมูลผู้ใช้งาน</h2>
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
            <div class="col-md-8 col-md-offset-2">
                <div id="profileedit">
                    <form enctype="multipart/form-data" id="edit-profile" method="POST" action="/profile/edit/{{$profile->id}}" class="form-horizontal">
                        <div class="sub-menu-title">ข้อมูลทั่วไป</div>
                        </br>
                        <div class="row">
                            {{ csrf_field() }}
                            <div class="col-xs-12 col-sm-8">
                                <div class="row">
                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-3 control-label">ชื่อ-นามสกุล</label>
                                        <div class="col-sm-4">
                                            <input class="form-control" name="firstname" type="text" value="{{$profile->firstname}}"  />
                                        </div>
                                        <div class="col-sm-4">
                                            <input class="form-control" name="lastname" type="text" value="{{$profile->lastname}}"  />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group">
                                        <label for="tel" class="col-sm-3 control-label">เบอร์ติดต่อ</label>
                                        <div class="col-sm-4">
                                            <input class="form-control" maxlength="10"  id="tel" name="tel" type="text" id="form-field-first" value="{{$profile->tel}}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-offset-3">
                                    <button class="btn btn-sm btn-warning" type="submit">
                                        <i class="fa fa-pencil"></i>
                                        แก้ไข
                                    </button>
                                    <a class="btn btn-sm btn-default" href="/home">
                                        <i class="fa fa-reply"></i>
                                        กลับ
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                </br></br></br>
                <div id="emailedit">
                    <form enctype="multipart/form-data" id="edit-profile-mail" method="POST" action="/profile/edit/{{$profile->id}}/mail" class="form-horizontal">
                        <div class="sub-menu-title">อีเมล์</div>
                        </br>
                        <div class="row">
                            {{-- {{ method_field('PUT') }} --}}
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="form-group">
                                    <label for="email" class="col-sm-2 control-label">อีเมลล์</label>
                                    <div class="col-sm-4">
                                        <input type="email" id="email" name="email" class="form-control input-large" value="{{$profile->email}}" data-bv-emailaddress-message="กรอกรูปแบบ Email : test@test.com">
                                    </div>
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
                        </div>
                    </form>
                </div>
                </br></br></br>
                <div id="row-address">
                    <div id="form-address">
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
                                                        ที่อยู่ {{$loop->iteration}}
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
                                                    <div class="col-sm-2">
                                                        <input type="text" id="postcode" name="postcode" maxlength="5" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tel" class="col-sm-3 control-label">เบอร์ติดต่อ*</label>
                                                    <div class="col-sm-4">
                                                        <input class="form-control" maxlength="10" id="tel" name="tel" type="text"/>
                                                    </div>
                                                </div>
                                                <div class="col-sm-offset-3">
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
                                                    <div class="col-sm-offset-3">
                                                        <button type="button" data-addressid="{{$address->id}}" class="btn btn-sm btn-danger bt-delete">
                                                            <i class="fa fa-trash"></i>
                                                            ลบที่อยู่
                                                        </button>
                                                    </div> 
                                                    <br>
                                                    <form id="edit-address{{$address->id}}" class="form-horizontal edit-address" method="POST" action="/address/edit/{{$address->id}}">
                                                        {{ csrf_field() }}
                                                        <div class="form-group">
                                                            <label for="fullname" class="col-sm-3 control-label">ชื่อในการจัดส่ง</label>
                                                            <div class="col-sm-6">
                                                                <input type="text" id="fullname" name="fullname" class="form-control" value="{{$address->fullname}}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="detail" class="col-sm-3 control-label">ที่อยู่</label>
                                                            <div class="col-sm-6">
                                                                <textarea cols="5" rows="5" id="detail" name="detail" class="form-control">{{$address->detail}}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="postcode" class="col-sm-3 control-label">รหัสไปรษณีย์</label>
                                                            <div class="col-sm-2">
                                                                <input type="text" id="postcode" name="postcode" maxlength="5" class="form-control" value="{{$address->postcode}}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="tel" class="col-sm-3 control-label">เบอร์ติดต่อ</label>
                                                            <div class="col-sm-4">
                                                                <input class="form-control" maxlength="10" id="tel" name="tel" type="text" id="form-field-first" value="{{$address->tel}}"/>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-offset-3">
                                                            <button class="btn btn-sm btn-warning btn-edit-address" type="submit">
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
        </div>
    </div>
@endsection


@section('script')
    <script type="text/javascript">
        $(document).ready(function(){
            // $("#form-address").load("/profile/address");
            // $('form')
            // .find('[name="tel"]')
            //     .intlTelInput({
            //         utilsScript: 'themes/ustora/js/utils.js',
            //         autoPlaceholder: true,
            //         preferredCountries: ['th']
            //     });
            // $('.input-mask-tel').mask('999-999-9999');
            function Address(){
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
                            $("#msgErrorArea").html("");
                            showMsgSuccess("#msgErrorArea", data.msgerror);
                            $("#row-address").load(data.url,function(){
                                Address();
                            });
                            // window.location = data.url;
                        }
                    }).fail(function () {
                        showMsgError("#msgErrorArea", data.msgerror);
                    });
                });

                $('form.edit-address').each(function () {
                    var id = $(this).attr("id");
                    $("#"+id).bootstrapValidator({
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
                    }).on("success.form.bv", function (e) {
                        // Prevent form submission
                        e.preventDefault();
                        // Get the form instance
                        var $form = $(e.target);
                        // console.log($form);
                        
                        var formdata = $form.serializeArray();
                        // console.log($form.attr('action'));

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
                                $("#msgErrorArea").html("");
                                showMsgSuccess("#msgErrorArea", data.msgerror);
                                $("#row-address").load(data.url,function(){
                                    Address();
                                });
                            }
                        }).fail(function () {
                            showMsgError("#msgErrorArea", data.msgerror);
                        });
                    });
                });
            }

            function editEmail(){
                $('#edit-profile-mail').bootstrapValidator({
                    framework: 'bootstrap',
                    fields: {
                        email: {
                            validators: {
                                notEmpty: {
                                    message: 'กรุณากรอก Email'
                                }
                            }
                        }
                    }
                }).on('success.field.bv', function(e, data) {
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
                        if (data.status !== 200) {
                            showMsgError("#msgErrorArea", data.msgerror);
                        } else {
                            $("#msgErrorArea").html("");
                            showMsgSuccess("#msgErrorArea", data.msgerror);
                            $("#emailedit").load(data.url,function(){
                                editEmail();
                            } );
                            // window.location = data.url;
                        }
                    }).fail(function () {
                        showMsgError("#msgErrorArea", data.msgerror);
                    });
                });
            }

            function editProfile(){
                $('#edit-profile').bootstrapValidator({
                    framework: 'bootstrap',
                    fields: {
                        firstname: {
                            validators: {
                                notEmpty: {
                                    message: 'กรุณากรอกชื่อ'
                                }
                            }
                        },
                        lastname: {
                            validators: {
                                notEmpty: {
                                    message: 'กรุณากรอกนามสกุล'
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
                                // ,callback: {
                                //     message: 'The phone number is not valid',
                                //     callback: function(value, validator, $field) {
                                //         return value === '' || $field.intlTelInput('isValidNumber');
                                //     }
                                // }
                            }
                        }
                    }
                }).on('success.field.bv', function(e, data) {
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
                        if (data.status !== 200) {
                            showMsgError("#msgErrorArea", data.msgerror);
                        } else {
                            $("#msgErrorArea").html("");
                            showMsgSuccess("#msgErrorArea", data.msgerror);
                            $("#profileedit").load(data.url,function(){
                                editProfile();
                            });
                            // window.location = data.url;
                        }
                    }).fail(function () {
                        showMsgError("#msgErrorArea", data.msgerror);
                    });
                });
            }

            $("#row-address").on('click', '.bt-delete', function () {
                var r = confirm("คุณต้องการลบรายการที่เลือก");
                if (r === true) {
                    var addressId = $(this).data("addressid");
                    var get = $.get("/address/delete/"+addressId);
                    get.done(function ($data) {
                        console.log($data);
                        if($data.status !== 200){
                            showMsgError("#msgErrorArea", data.msgerror);
                        }else{
                            $("#msgErrorArea").html("");
                            showMsgSuccess("#msgErrorArea", "ลบข้อมูลเรียบร้อย");
                            $("#row-address").load("/profile #form-address",function(){
                                Address();
                            });
                        }
                    });
                }
            });

            editProfile();
            editEmail();
            Address();
        });
    </script>
@endsection
