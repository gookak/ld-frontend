@extends('layouts/main')
{{-- @extends('layouts/app') --}}

@section('content')
<style type="text/css">
    .caption-group > h2{
        /*font-size:1em;*/
        /*line-height:1.1em;*/
        height:3.3em;
    }
    .caption-name{
        line-height:1.2em;
        height:3em;
    }
</style>

{{-- <div class="single-product-area"> --}}
    {{-- หน้าจอขนาดมากกว่า 769px --}}
    @if ($topsellers->count())
        <div class="slider-area">
            <!-- Slider -->
            <div class="block-slider block-slider4">
                <ul class="" id="bxslider-home4">
                    @foreach($topsellers as $topseller)
                    <li>
                        <div class="row">
                        <div class="col-sm-6">
                            <div class="img-resize-home">
                                @if(count($topseller->product->productImage) > 0)
                                <img width="200" height="auto" class="img-responsive" src="{{ asset(env('FILE_URL').$topseller->product->productImage[0]->fileupload->filename )}}" alt="Slide">
                                @else
                                <img width="200" height="auto" class="img-responsive" src="{{ asset(env('FILE_URL')."noimage.jpg" )}}" alt="Slide">
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-6" style="padding-top: 25px; padding-left: 25px;">
                            <div class="caption-group">
                                <h2 class="caption title">
                                    <span class="primary"><strong>{{$topseller->product->name}}</strong></span>
                                </h2>
                                
                                <span class="label label-danger caption subtitle">ขายดี</span>
                                @if($topseller->product->balance <= 0)
                                    <span class="label label-warning">หมด</span>
                                @endif
                                <h4 class="caption subtitle">ราคา {{ number_format($topseller->product->price,2) }} บาท</h4>
                                <a class="caption button-radius" href="/productDetail/{{$topseller->product->id}}"><span class="icon"></span>รายละเอียด</a>
                            </div>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
            <!-- ./Slider -->
        </div> <!-- End slider area -->
    @endif

    {{-- หน้าจอเล็กกว่า 769 px --}}
    @if ($topsellers->count())
        <div class="maincontent-area seller-responsive">
            <div class="zigzag-bottom"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="latest-product">
                            <div>
                                <span class="sub-menu-title">สินค้าขายดี</span>
                            </div>
                            <div class="product-carousel">
                                @foreach($topsellers as $topseller)
                                    <div class="single-product">
                                        <div class="product-f-image">
                                            <div class="img-resize">
                                                @if(count($topseller->product->productImage) > 0)
                                                <img width="200" height="auto" class="img-responsive img-center" src="{{ asset(env('FILE_URL').$topseller->product->productImage[0]->fileupload->filename )}}" alt="Slide">
                                                @else
                                                <img width="200" height="auto" class="img-responsive img-center" src="{{ asset(env('FILE_URL')."noimage.jpg" )}}" alt="Slide">
                                                @endif
                                            </div>
                                            <div class="product-hover">
                                                @if($topseller->product->balance > 0)
                                                <button type="button" class="add-to-cart-link add_item_cart" data-productid="{{$topseller->product->id}}"><i class="fa fa-shopping-cart"></i> เลือกสินค้า</button>
                                                @endif
                                                <a href="/productDetail/{{$topseller->product->id}}" class="view-details-link"><i class="fa fa-link"></i> รายละเอียด</a>
                                            </div>
                                        </div>

                                        <h2 class="caption-name"><a href="/productDetail/{{$topseller->product->id}}">{{$topseller->product->name}}</a></h2>
                                        <span class="label label-danger">ขายดี</span>
                                        @if($topseller->product->balance <= 0)
                                            <span class="label label-warning">หมด</span>
                                        @endif
                                        <div class="product-carousel-price">
                                            ราคา {{ number_format($topseller->product->price,2) }} บาท
                                        </div> 
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="promo-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row row-flex row-flex-wrap">
                <div class="col-md-3 col-sm-6 flex-auto">
                    <div class="single-promo promo1" style="width: 100%">
                        <i class="fa fa-refresh"></i>
                        <p>สินค้าราคาถูก</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 flex-auto">
                    <div class="single-promo promo2" style="width: 100%">
                        <i class="fa fa-truck"></i>
                        <p>ฟรี ค่าขนส่ง(EMS)</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 flex-auto">
                    <div class="single-promo promo3" style="width: 100%">
                        <i class="fa fa-usd"></i>
                        <p>เก็บเงินสินค้าปลายทาง</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 flex-auto">
                    <div class="single-promo promo4" style="width: 100%">
                        <i class="fa fa-gift"></i>
                        <p>สินค้าใหม่</p>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End promo area -->
    @if (count($productlatest))
    <div class="maincontent-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="latest-product">
                        <h2 class="section-title sub-menu-title">สินค้าล่าสุด</h2>
                        {{-- แก้ prev and next ที่ navtext ไฟล์ owl.carousel.min.js --}}
                        <div class="product-carousel">
                            @foreach($productlatest as $product)
                            <div class="single-product">
                                <div class="product-f-image">
                                    <div class="img-resize">
                                        @if(count($product->productImage) > 0)
                                        <img width="200" height="auto" class="img-responsive img-center" src="{{ asset(env('FILE_URL').$product->productImage[0]->fileupload->filename )}}" alt="Slide">
                                        @else
                                        <img width="200" height="auto" class="img-responsive img-center" src="{{ asset(env('FILE_URL')."noimage.jpg" )}}" alt="Slide">
                                        @endif
                                    </div>
                                    <div class="product-hover">
                                        @if($product->balance > 0)
                                        <button type="button" class="add-to-cart-link add_item_cart" data-productid="{{$product->id}}"><i class="fa fa-shopping-cart"></i> เลือกสินค้า</button>
                                        @endif
                                        <a href="/productDetail/{{$product->id}}" class="view-details-link"><i class="fa fa-link"></i> รายละเอียด</a>
                                    </div>
                                </div>
                                <h2 class="caption-name">
                                    <a href="/productDetail/{{$product->id}}">{{$product->name}}</a>
                                </h2>
                                <span class="label label-info">ใหม่</span>
                                @if($product->hot)
                                <span class="label label-danger">ขายดี</span>
                                @endif
                                @if($product->balance <= 0)
                                <span class="label label-warning">หมด</span>
                                @endif
                                <div class="product-carousel-price">
                                    ราคา {{ number_format($product->price,2) }} บาท
                                </div> 
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End main content area -->
    @endif

    @foreach($category_list as $category)
    @if ($category->product->count())
    <div class="maincontent-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="latest-product">
                        <div>
                            <span class="sub-menu-title">{{$category->name}}</span>&nbsp;
                            <a href="/product?category_id={{$category->id}}" class="btn btn-xs btn-primary">ดูทั้งหมด</a>
                        </div>
                        {{-- แก้ prev and next ที่ navtext ไฟล์ owl.carousel.min.js --}}
                        <div class="product-carousel">
                            @foreach($category->product->shuffle() as $key=>$product)
                            @if ($loop->index > 10)
                                @break
                            @endif
                            <div class="single-product">
                                <div class="product-f-image">
                                    <div class="img-resize">
                                        @if(count($product->productImage) > 0)
                                        <img width="200" height="auto" class="img-responsive img-center" src="{{ asset(env('FILE_URL').$product->productImage[0]->fileupload->filename )}}">
                                        @else
                                        <img width="200" height="auto"  class="img-responsive img-center" src="{{ asset(env('FILE_URL')."noimage.jpg" )}}" alt="Slide">
                                        @endif
                                    </div>
                                    <div class="product-hover">
                                        @if($product->balance > 0)
                                        <button type="button" class="add-to-cart-link add_item_cart" data-productid="{{$product->id}}"><i class="fa fa-shopping-cart"></i> เลือกสินค้า</button>
                                        @endif
                                        <a href="/productDetail/{{$product->id}}" class="view-details-link"><i class="fa fa-link"></i> รายละเอียด</a>
                                    </div>
                                </div>

                                <h2 class="caption-name"><a href="/productDetail/{{$product->id}}">{{$product->name}}</a></h2>
                                     @if($product->numdate <= 7)
                                    <span class="label label-info">ใหม่</span>
                                    @endif
                                    @if($product->hot)
                                    <span class="label label-danger">ขายดี</span>
                                    @endif
                                    @if($product->balance <= 0)
                                    <span class="label label-warning">หมด</span>
                                    @endif
                                <div class="product-carousel-price">
                                    ราคา {{ number_format( $product->price,2) }} บาท
                                </div> 
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @endforeach
{{-- </div> --}}

@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function(){

        $(".add_item_cart").click(function(){
            var productId = $(this).data("productid");
            // var qty =  $(this).data("qty");
            $.get("/cart/addProduct/"+productId,function(data){
                // $(".cart-reload").load("/product .shopping-item");
                $(".shoppingcart").load("/product span.cart-item");
            });

        });

        $('img').error(function () {
            $(this).attr({
                src: "{{ asset(env('FILE_URL')."noimage.jpg" )}}"
            });
            // $(this).parent("a").attr({
            //     href: "{{ asset(env('FILE_URL')."noimage.jpg" )}}"
            // });
        });

        $('.caption-group > h2').dotdotdot({
            ellipsis: '...', /* The HTML to add as ellipsis. */
            wrap : 'word', /* How to cut off the text/html: 'word'/'letter'/'children' */
            watch : true /* Whether to update the ellipsis: true/'window' */
        });

        $('.caption-name').dotdotdot({
            ellipsis: '...', /* The HTML to add as ellipsis. */
            wrap : 'word', /* How to cut off the text/html: 'word'/'letter'/'children' */
            watch : true /* Whether to update the ellipsis: true/'window' */
        });
    });
</script>
@endsection
