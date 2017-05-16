@extends('layouts/main')

@section('content')
<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Product Detail</h2>
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
                            Search Products
                        </div>
                        <form id="search" action="/product" class="search-collapse collapse" method="GET">
                            <p class="form-row">
                                <label for="name">ชื่อสินค้า</label>
                                <input type="text" id="name" name="name" class="input-text form-control" placeholder="Name products..." value="{{Request::input('name')? Request::input('name') : null}}">  
                            </p>
                            <p class="form-row">
                                <label for="category_id">ประเภทสินค้า</label>
                                <select id="category_id" name="category_id" class="form-control">
                                    <option value="">เลือกประเภท...</option>
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
                            <button type="submit"><i class="fa fa-search"></i> Search</button>
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
                            <a href="/product?category_id={{$category->id}}" class="list-group-item">{{$category->name}}</a>
                            @endforeach
                        </div>
                    </div>
            </div>

            <div class="col-md-9">
                <div class="product-content-right">
                    <div class="product-breadcroumb">
                        <a href="/">Home</a>
                        <a href="/product?category_id={{$product->category_id}}">{{$product->category->name}}</a>
                        <span>{{$product->name}}</span>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="product-images">
                                <div class="product-main-img">
                                    <img src="{{ asset('themes/ustora/img/product-2.jpg') }}" alt="">
                                </div>

                                <div class="product-gallery">
                                    <img src="{{ asset('themes/ustora/img/product-thumb-1.jpg') }}" alt="">
                                    <img src="{{ asset('themes/ustora/img/product-thumb-2.jpg') }}" alt="">
                                    <img src="{{ asset('themes/ustora/img/product-thumb-3.jpg') }}" alt="">
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="product-inner">
                                <h2 class="product-name">{{$product->name}}</h2>
                                <div class="product-inner-price">
                                    {{$product->price}}
                                </div>    

                                {{-- <form name="cartAdd" action="/product" method="GET"> --}}
                                    <input type="hidden" value="{{$product->id}}" name="productid">
                                    <div class="quantity">
                                       <input type="number" size="4" class="input-text qty text" title="Qty" value="1" name="qty" min="1" step="1">
                                    </div>
                                   <button class="add_to_cart_button add_item_cart" type="submit">Add to cart</button>
                                {{-- </form>    --}}

                                <div class="product-inner-category">
                                    <p>Category: <a href="/product?category_id={{$product->category_id}}">{{$product->category->name}}</a>
                                    {{-- Tags: <a href="">awesome</a>, <a href="">best</a>, <a href="">sale</a>, <a href="">shoes</a>. --}} </p>
                                </div> 

                                <div role="tabpanel">
                                    <ul class="product-tab" role="tablist">
                                        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Description</a></li>
                                        {{-- <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Reviews</a></li> --}}
                                    </ul>
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade in active" id="home">
                                            <h2>Product Description</h2>  
                                            <p>{{$product->detail}}</p>
                                        </div>
                                        {{-- <div role="tabpanel" class="tab-pane fade" id="profile">
                                            <h2>Reviews</h2>
                                            <div class="submit-review">
                                                <p><label for="name">Name</label> <input name="name" type="text"></p>
                                                <p><label for="email">Email</label> <input name="email" type="email"></p>
                                                <div class="rating-chooser">
                                                    <p>Your rating</p>

                                                    <div class="rating-wrap-post">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                </div>
                                                <p><label for="review">Your review</label> <textarea name="review" id="" cols="30" rows="10"></textarea></p>
                                                <p><input type="submit" value="Submit"></p>
                                            </div>
                                        </div> --}}
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>


                    {{-- <div class="related-products-wrapper">
                        <h2 class="related-products-title">Related Products</h2>
                        <div class="related-products-carousel">
                            <div class="single-product">
                                <div class="product-f-image">
                                    <img src="img/product-1.jpg" alt="">
                                    <div class="product-hover">
                                        <a href="" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                                        <a href="" class="view-details-link"><i class="fa fa-link"></i> See details</a>
                                    </div>
                                </div>

                                <h2><a href="">Sony Smart TV - 2015</a></h2>

                                <div class="product-carousel-price">
                                    <ins>$700.00</ins> <del>$100.00</del>
                                </div> 
                            </div>
                            <div class="single-product">
                                <div class="product-f-image">
                                    <img src="img/product-2.jpg" alt="">
                                    <div class="product-hover">
                                        <a href="" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                                        <a href="" class="view-details-link"><i class="fa fa-link"></i> See details</a>
                                    </div>
                                </div>

                                <h2><a href="">Apple new mac book 2015 March :P</a></h2>
                                <div class="product-carousel-price">
                                    <ins>$899.00</ins> <del>$999.00</del>
                                </div> 
                            </div>
                            <div class="single-product">
                                <div class="product-f-image">
                                    <img src="img/product-3.jpg" alt="">
                                    <div class="product-hover">
                                        <a href="" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                                        <a href="" class="view-details-link"><i class="fa fa-link"></i> See details</a>
                                    </div>
                                </div>

                                <h2><a href="">Apple new i phone 6</a></h2>

                                <div class="product-carousel-price">
                                    <ins>$400.00</ins> <del>$425.00</del>
                                </div>                                 
                            </div>
                            <div class="single-product">
                                <div class="product-f-image">
                                    <img src="img/product-4.jpg" alt="">
                                    <div class="product-hover">
                                        <a href="" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                                        <a href="" class="view-details-link"><i class="fa fa-link"></i> See details</a>
                                    </div>
                                </div>

                                <h2><a href="">Sony playstation microsoft</a></h2>

                                <div class="product-carousel-price">
                                    <ins>$200.00</ins> <del>$225.00</del>
                                </div>                            
                            </div>
                            <div class="single-product">
                                <div class="product-f-image">
                                    <img src="img/product-5.jpg" alt="">
                                    <div class="product-hover">
                                        <a href="" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                                        <a href="" class="view-details-link"><i class="fa fa-link"></i> See details</a>
                                    </div>
                                </div>

                                <h2><a href="">Sony Smart Air Condtion</a></h2>

                                <div class="product-carousel-price">
                                    <ins>$1200.00</ins> <del>$1355.00</del>
                                </div>                                 
                            </div>
                            <div class="single-product">
                                <div class="product-f-image">
                                    <img src="img/product-6.jpg" alt="">
                                    <div class="product-hover">
                                        <a href="" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                                        <a href="" class="view-details-link"><i class="fa fa-link"></i> See details</a>
                                    </div>
                                </div>

                                <h2><a href="">Samsung gallaxy note 4</a></h2>

                                <div class="product-carousel-price">
                                    <ins>$400.00</ins>
                                </div>                            
                            </div>                                    
                        </div>
                    </div> --}}
                </div>                    
            </div>
        </div>
    </div>
</div>
@endsection


@section('script')
<script type="text/javascript">
    $(document).ready(function(){
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
                $( "#price" ).html( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
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
        $( "#price" ).html( "$" + $( "#slider-range" ).slider( "values", 0 ) + " - $" + $( "#slider-range" ).slider( "values", 1 ) );


        $(".add_item_cart").click(function(){
            var productId = $("input[name=productid]").val();
            var qty =  $("input[name=qty]").val();
            $.get("/cart/addProduct/"+productId,{"qty" : qty},function(data){
                $(".cart-reload").load("/product .shopping-item");
            });
        });
    });
</script>
@endsection
