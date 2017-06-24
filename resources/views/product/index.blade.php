@extends('layouts/main')

@section('content')
<style type="text/css">
    .caption > h3{
        /*font-size:1em;*/
        /*line-height:1.1em;*/
        height:3.3em;
    }
</style>

<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>สินค้า</h2>
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
                        {{-- {{ csrf_field() }} --}}
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
                            <input type="hidden" id="price_max" name="price_max" value="{{Request::input('price_max')? Request::input('price_max') : null}}">
                        </p>
                    </br>
                    <p class="form-row">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> ค้นหา</button>
                    </p>
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
                    <a href="/product?category_id={{$category->id}}" class="list-group-item {{Request::input('category_id') == $category->id? 'active': null}}">{{$category->name}}</a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="clearfix">
                <div id="msgErrorArea"></div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                        {{-- <div class="product-breadcroumb">
                            <a href="/">หน้าแรก</a>
                            <a href="/product?category_id={{$category_current->id}}">{{$category_current->name}}</a>
                        </div>
                        --}}                    </div>
                        <div class="col-sm-6 text-right">
                            <div>
                                <form name="sortby" action="/product" method="GET">
                                    <input type="hidden" name="name" value="{{Request::input('name')}}">
                                    <input type="hidden" name="category_id" value="{{Request::input('category_id')}}">
                                    <input type="hidden" name="price_min" value="{{Request::input('price_min')}}">
                                    <input type="hidden" name="price_max" value="{{Request::input('price_max')}}">
                                    <label class="col-xs-12 col-sm-6" for="sortby">เรียงตาม</label>
                                    <div class="col-xs-12 col-sm-6">
                                        <select id="sortby" name="sortby" class="form-control">
                                            <option value="latest" {{Request::input('sortby') == "latest"? "selected" : null}}>ล่าสุด</option>
                                            <option value="pricedesc" {{Request::input('sortby') == "pricedesc"? "selected" : null}}>ราคาสูงสุด-ต่ำสุด</option>
                                            <option value="priceasc" {{Request::input('sortby') == "priceasc"? "selected" : null}}>ราคาต่าสุด-สูงสุด</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </br>
                <div class="row row-flex row-flex-wrap product">
                    @if ($products->count())
                    @foreach($products as $product)
                    <div class="col-xs-12 col-md-4 col-sm-6">
                        <div class="ace-thumbnails clearfix thumbnail" style="width: 100%">
                            <div class="img-resize">
                                <a href="/productDetail/{{$product->id}}"> 
                                 @if(count($product->productImage) > 0)
                                 <img width="200" height="auto" class="img-responsive" src="{{ asset(env('FILE_URL').$product->productImage[0]->fileupload->filename )}}">
                                 @else
                                 <img width="200" height="auto" class="img-responsive" src="{{ asset(env('FILE_URL')."noimage.jpg" )}}">
                                 @endif
                             </a>
                         </div>
                         <div class="caption">
                            <h3><a href="/productDetail/{{$product->id}}">{{ $product->name }}</a></h3>
                            @if($product->numdate <= 7)
                            <span class="label label-info">ใหม่</span>
                            @endif
                            @if($product->hot)
                            <span class="label label-danger">ขายดี</span>
                            @endif
                            @if($product->balance <= 0)
                            <span class="label label-warning">หมด</span>
                            @endif
                            <p>ราคา {{ number_format($product->price,2) }} บาท</p>
                            <p>
                                @if($product->balance > 0)
                                <button class="btn btn-primary add_item_cart" data-productid="{{$product->id}}"><i class="fa fa-shopping-cart"></i> เลือกสินค้า</button> 
                                @endif
                                <a href="/productDetail/{{$product->id}}" class="btn btn-default" role="button">รายละเอียด</a>
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <div class="col-md-12">
                    <h2>ไม่พบข้อมูล</h2>                  
                </div>       
                @endif
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="product-pagination text-center">
                        {{ $products->appends(Request::all())->render() }}
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
        });

        $('.caption > h3').dotdotdot({
            ellipsis: '...', /* The HTML to add as ellipsis. */
            wrap : 'word', /* How to cut off the text/html: 'word'/'letter'/'children' */
            watch : true /* Whether to update the ellipsis: true/'window' */
        });

        var min = 0;
        var max = {{$maxprice}};
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



        $("#sortby").change(function(){
            $("form[name=sortby]").submit();
        });

        $('#search').on('keyup keypress', function(e) {
            var keyCode = e.keyCode || e.which;
            if (keyCode === 13) { 
                e.preventDefault();
                return false;
            }
        });


        $(".add_item_cart").click(function(){
            var productId = $(this).data("productid");
            // var qty =  $(this).data("qty");

            $.get("/cart/addProduct/"+productId,function(data){
                if (data.status == 200) {
                    $("#msgErrorArea").html("");
                    showMsgSuccess("#msgErrorArea", data.msgerror);
                    // $(".shoppingcart").load("/product span.cart-item");
                    $(".shoppingcart").load(data.url);
                }else{
                    showMsgError("#msgErrorArea", data.msgerror);
                }
                
            });

        });
    });
</script>
@endsection
