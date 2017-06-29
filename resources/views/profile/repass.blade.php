@extends('layouts/main')

@section('content')
<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>รีเซ็ตรหัสผ่าน</h2>
                </div>
            </div>
        </div>
    </div>
</div>
</br>
<div class="single-product-area">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">เปลี่ยนรหัสผ่าน</div>

                    <div class="panel-body">
                            <div class="clearfix">
                                <div id="msgErrorArea"></div>
                            </div>

                        <form id="repass" class="form-horizontal" role="form" method="POST" action="/profile/repass/{{$profile->id}}">
                            {{ csrf_field() }}

                            {{-- <div class="row">
                                <div class="form-group">
                                    <label for="email" class="col-sm-2 control-label">อีเมลล์</label>
                                    <div class="col-sm-6">
                                        <input type="email" id="email" name="email" class="form-control input-large" value="{{$profile->email}}" disabled>
                                    </div>
                                </div>
                            </div> --}}

                            {{-- <div class="row">
                                <div class="form-group">
                                    <label for="password" class="col-sm-2 control-label">รหัสผ่านเก่า</label>
                                    <div class="col-sm-6">
                                        <input type="password" id="oldpassword" name="oldpassword" class="form-control input-large">
                                    </div>
                                </div>
                            </div> --}}

                            <div class="row">
                                <div class="form-group">
                                    <label for="password" class="col-sm-2 control-label">รหัสผ่านใหม่*</label>
                                    <div class="col-sm-6">
                                        <input type="password" id="newpassword" name="newpassword" class="form-control input-large">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group">
                                    <label for="confirmpass" class="col-sm-2 control-label">ยืนยันรหัสผ่าน*</label>
                                    <div class="col-sm-6">
                                        <input type="password" id="confirmpass" name="confirmpass" class="form-control input-large">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        รีเซ็ตรหัสผ่าน
                                    </button>
                                </div>
                            </div>
                        </form>
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

$('#repass').bootstrapValidator({
    framework: 'bootstrap',
    fields: {
        // oldpassword: {
        //     validators: {
        //         stringLength: {
        //             min: 6,
        //             message: 'กรอกรหัสอย่างน้อย 6 ตัว'
        //         }
        //     }
        // },
        newpassword: {
            validators: {
                identical: {
                    field: 'confirmpass',
                    message: 'รหัสผ่านไม่ตรงกัน'
                },
                stringLength: {
                    min: 6,
                    message: 'กรอกรหัสอย่างน้อย 6 ตัว'
                }
            }
        },
        confirmpass: {
            validators: {
                identical: {
                    field: 'newpassword',
                    message: 'รหัสผ่านไม่ตรงกัน'
                },
                stringLength: {
                    min: 6,
                    message: 'กรอกรหัสอย่างน้อย 6 ตัว'
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
                    $('#repass').bootstrapValidator("resetForm",true); 
                    // window.location = data.url;
                }
            }).fail(function () {
                showMsgError("#msgErrorArea", data.msgerror);
            });
        });
});
</script>
@endsection