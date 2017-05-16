@extends('layouts/main')

@section('content')
<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Shop</h2>
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
                    {{-- {{ csrf_field() }} --}}
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
            <div class="row">
                <div class="col-sm-6">
                    <div class="product-breadcroumb">
                        <a href="/">Home</a>
                        <a href="/product?category_id={{$category_current->id}}">{{$category_current->name}}</a>
                    </div>
                </div>
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
        <div class="row product">
            <div class="productlist">
                @if ($products->count())
                @foreach($products as $product)
                <div class="col-md-3 col-sm-6">
                    <div class="single-shop-product">
                        <div class="product-upper">
                            <img src="{{ asset(env('FILE_URL')."")}}" alt="">
                        </div>
                        <h2><a href="/productDetail/{{$product->id}}">{{ $product->name }}</a></h2>
                        <div class="product-carousel-price">
                            {{ $product->price }}
                        </div>  

                        <div class="product-option-shop">
                            <button class="add_to_cart_button add_item_cart" data-productid="{{$product->id}}"><i class="fa fa-shopping-cart"></i> Add to cart</button>
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
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="product-pagination text-center">
         {{--  {{ $products->appends(Request::only('category'))->appends(Request::only('search'))->render() }} --}}

         {{ $products->appends(Request::all())->render() }}


         {{-- {{ $products->appends(Request::only('search'))->links() }} --}}
                                   {{--  <nav>
                                      <ul class="pagination">
                                        <li>
                                          <a href="#" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                    <li><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">4</a></li>
                                    <li><a href="#">5</a></li>
                                    <li>
                                      <a href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>     --}}                    
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



            $("#sortby").change(function(){
                $("form[name=sortby]").submit();
            });

            $(".add_item_cart").click(function(){
                var productId = $(this).data("productid");
            // var qty =  $(this).data("qty");
            $.get("/cart/addProduct/"+productId,function(data){
                $(".cart-reload").load("/product .shopping-item");
            });

        });
        });
    </script>
    @endsection
