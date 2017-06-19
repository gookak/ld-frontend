@extends('layouts/main')

@section('content')
<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>รายละเอียดสินค้า</h2>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="single-product-area">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="single-sidebar">
                    <div class="sub-menu-title">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".search-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        ค้นหาสินค้า
                    </div>
                    <form id="search" action="/product" class="search-collapse collapse" method="GET">
                        <p class="form-row">
                            <label for="name">ชื่อสินค้า</label>
                            <input type="text" id="name" name="name" class="input-text form-control" placeholder="ชื่อสินค้า..." value="{{Request::input('name')? Request::input('name') : null}}">  
                        </p>
                        <p class="form-row">
                            <label for="category_id">ประเภทสินค้า</label>
                            <select id="category_id" name="category_id" class="form-control">
                                <option {{Request::input('category_id') == "all"? "selected" : null}} value="all">ทุกประเภท</option>
                                @foreach($category_list as $category)
                                <option value="{{$category->id}}" {{Request::input('category_id') == $category->id? "selected" : null}}>{{$category->name}}</option>
                                @endforeach
                            </select>
                        </p>
                        <p class="form-row">
                            <label>ราคา: <span id="price"></span></label>
                            <div id="slider-range"></div>
                            <input type="hidden" id="price_min" name="price_min" value="{{Request::input('price_min')? Request::input('price_min') : null}}">
                            <input type="hidden" id="price_max" name="price_max" value="{{Request::input('price_max')? Request::input('price_max'): null}}">
                        </p>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> ค้นหา</button>
                    </form>
                </div>

                <div class="single-sidebar">
                    <div class="sub-menu-title">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".list-group-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        ประเภทสินค้า
                    </div>

                    <div class="list-group list-group-collapse collapse">
                        @foreach($category_list as $category)
                        <a href="/product?category_id={{$category->id}}" class="list-group-item {{$product->category_id == $category->id? 'active': null}}">{{$category->name}}</a>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="product-content-right">
                    <div class="product-breadcroumb">
                        <a href="/">หน้าแรก</a>
                        <a href="/product?category_id={{$product->category_id}}">{{$product->category->name}}</a>
                        <span>{{$product->name}}</span>
                    </div>
                    <div class="clearfix">
                        <div id="msgErrorArea"></div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="product-images">
                                @if(count($product->productImage) > 0)

                                <div class="product-main-img ace-thumbnails clearfix">
                                    <a href="{{ asset(env('FILE_URL').$product->productImage[0]->fileupload->filename )}}" data-rel="colorbox">
                                        <img height="auto" width="300" class="img-responsive" src="{{ asset(env('FILE_URL').$product->productImage[0]->fileupload->filename )}}" />
                                    </a>
                                </div>
                                <div class="product-gallery ace-thumbnails clearfix">
                                    @foreach($product->productImage as $key=>$productImage)
                                    @if($key != 0)
                                    <a href="{{ asset(env('FILE_URL').$productImage->fileupload->filename )}}" data-rel="colorbox">
                                        <img class="img-responsive" src="{{ asset(env('FILE_URL').$productImage->fileupload->filename )}}">
                                    </a>
                                    @endif
                                    @endforeach
                                </div>

                                @else
                                <a href="{{ asset(env('FILE_URL')."noimage.jpg" )}}" data-rel="colorbox">
                                    <img height="auto" width="300" class="img-responsive" src="{{ asset(env('FILE_URL')."noimage.jpg" )}}">
                                </a>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="product-inner">
                                <h2 class="product-name">{{$product->name}}</h2>
                                @if($product->numdate <= 7)
                                <span class="label label-info">ใหม่</span>
                                @endif
                                @if($product->hot)
                                <span class="label label-danger">ขายดี</span>
                                @endif
                                @if($product->balance <= 0)
                                <span class="label label-warning">หมด</span>
                                @endif
                                <div class="product-inner-price">
                                    ราคา {{number_format($product->price,2)}} บาท
                                </div>    
                                <div class="">
                                    <p>สินค้าคงเหลือ: {{$product->balance}} ชิ้น</p>
                                </div> 
                                @if($product->balance > 0)
                                <input type="hidden" value="{{$product->id}}" name="productid">
                                <div class="quantity">
                                    จำนวน <input type="number" size="4" class="input-text qty text" title="Qty" value="1" name="qty" min="1" max="{{$product->balance}}" step="1">
                                </div>
                                <button class="add_to_cart_button add_item_cart" type="submit">เลือกสินค้า</button>
                                @endif
                                <div class="product-inner-category" style="margin-top: 10px;">
                                    <p>ประเภท: <a href="/product?category_id={{$product->category_id}}">{{$product->category->name}}</a></p>
                                </div> 

                                <div role="tabpanel">
                                    <ul class="product-tab" role="tablist">
                                        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">รายละเอียดสินค้า</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade in active" id="home"> 
                                            <p>{{$product->detail}}</p>
                                        </div>
                                    </div>
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
    $(document).ready(function() {

        var min = 0;
        var max = {{ $maxprice }};
        var price_min = {{Request::input('price_min')? Request::input('price_min') : 0}};
        var price_max = {{Request::input('price_max')? Request::input('price_max') : $maxprice}};
        $( "#slider-range" ).slider({
            range: true,
            min: min,
            max: max,
            values: [ price_min, price_max ],
            slide: function( event, ui ) {
                function addCommas(nStr)
                {
                    nStr += '';
                    x = nStr.split('.');
                    x1 = x[0];
                    x2 = x.length > 1 ? '.' + x[1] : '';
                    var rgx = /(\d+)(\d{3})/;
                    while (rgx.test(x1)) {
                        x1 = x1.replace(rgx, '$1' + ',' + '$2');
                    }
                    return x1 + x2;
                }
                $( "#price" ).html(addCommas(ui.values[ 0 ].toFixed(2)) + " บาท - " + addCommas(ui.values[ 1 ].toFixed(2))+ " บาท" );
                $( "#price_min" ).val(ui.values[ 0 ]);
                $( "#price_max" ).val(ui.values[ 1 ]);


                var val = ui.values[$(ui.handle).index()-1] + "";

                if( !ui.handle.firstChild ) {
                    $("<div class='tooltip bottom in' style='display:none;left:-12px;top:14px;'><div class='tooltip-arrow'></div><div class='tooltip-inner'></div></div>")
                    .prependTo(ui.handle);
                }
                $(ui.handle.firstChild).show().children().eq(1).text(val);
            }
        }).find('span.ui-slider-handle').on('blur', function(){
            $(this.firstChild).hide();
        });
        $( "#price" ).html( $( "#slider-range" ).slider( "values", 0 ).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + " บาท - " + $( "#slider-range" ).slider( "values", 1 ).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")+ " บาท" );

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

    $('#search').on('keyup keypress', function(e) {
            var keyCode = e.keyCode || e.which;
            if (keyCode === 13) { 
                e.preventDefault();
                return false;
            }
        });

    $(".add_item_cart").click(function(){
        var productId = $("input[name=productid]").val();
        var qty =  $("input[name=qty]").val();
        $.get("/cart/addProduct/"+productId,{"qty" : qty},function(data){
           if (data.status == 200) {
                showMsgSuccess("#msgErrorArea", data.msgerror);
                $("input[name=qty]").val("1");
                $(".shoppingcart").load(data.url);
            }else{
                showMsgError("#msgErrorArea", data.msgerror);
            }
        });
    });

    $('img').error(function () {
            $(this).attr({
                src: "{{ asset(env('FILE_URL')."noimage.jpg" )}}"
            });
            $(this).parent("a").attr({
                href: "{{ asset(env('FILE_URL')."noimage.jpg" )}}"
            });
        });
});
</script>
@endsection
