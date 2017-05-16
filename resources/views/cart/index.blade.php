@extends('layouts/main')

@section('content')
<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Shopping Cart</h2>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End Page title area -->


<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-content-right">
                    <div class="woocommerce">
                        <form method="post" class="shop_form" action="#">
                            <table cellspacing="0" class="shop_table cart">
                                <thead>
                                    <tr>
                                        <th class="product-remove">&nbsp;</th>
                                        <th class="product-thumbnail">&nbsp;</th>
                                        <th class="product-name">Product</th>
                                        <th class="product-price">Price</th>
                                        <th class="product-quantity">Quantity</th>
                                        <th class="product-subtotal">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if(Session::has('cart'))
                                {{-- @if(Cookie::get('cart')) --}}
                                @foreach($products as $product)
                                    <tr class="cart_item">
                                        <td class="product-remove">
                                            <button type="button" class="btn btn-xs btn-danger removeItem" data-productid="{{$product['item']['id']}}"><i class="fa fa-times"></i></button> 
                                        </td>

                                        <td class="product-thumbnail">
                                             <a href="single-product.html"><img width="145" height="145" alt="poster_1_up" class="shop_thumbnail" src="{{ asset('themes/ustora/img/product-thumb-2.jpg') }}"></a>
                                        </td>

                                        <td class="product-name">
                                            <a href="/productDetail/{{$product['item']['id']}}">{{$product['item']['name']}}</a> 
                                        </td>

                                        <td class="product-price">
                                            <span class="amount">{{$product['item']['price']}}</span> 
                                        </td>

                                        <td class="product-quantity">
                                            <div class="quantity buttons_added">
                                                <button type="button" class="btn btn-xs btn-primary minusItem" data-productid="{{$product['item']['id']}}"><i class="fa fa-minus"></i></button> 
                                                <input type="text" readonly size="1" class="input-text qty text" title="Qty" value="{{$product['qty']}}">
                                                <button type="button" class="btn btn-xs btn-primary plusItem" data-productid="{{$product['item']['id']}}"><i class="fa fa-plus"></i></button> 
                                            </div>
                                        </td>

                                        <td class="product-subtotal">
                                            <span class="amount">{{$product['price']}}</span> 
                                        </td>
                                    </tr>
                                @endforeach
                                @else
                                <tr><td colspan="6">ไม่มีข้อมูล</td></tr>
                                @endif
                                    {{-- <tr>
                                        <td class="actions" colspan="6">
                                            <input type="submit" value="Update Cart" name="update_cart" class="button">
                                            <input type="submit" value="Checkout" name="proceed" class="checkout-button button alt wc-forward">
                                        </td>
                                    </tr> --}}
                                </tbody>
                            </table>
                        </form>

                        <div class="cart-collaterals">

                            <div class="cart_totals">
                                <div class="shop_total">
                                    <h2>Cart Totals</h2>

                                    <table cellspacing="0">
                                        <tbody>
                                            <tr class="cart-subtotal">
                                                <th>Order Total</th>
                                                <td><span class="amount">{{$totalQty}}</span></td>
                                            </tr>

                                            <tr class="order-total">
                                                <th>Total Price</th>
                                                <td><strong><span class="amount">{{$totalPrice}}</span></strong> </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="text-center">
                                <h2><a href="/checkout" name="checkout" class="btn btn-primary">Check out</a></h2>
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

        $(".woocommerce").on("click",".minusItem",function(){
            var productId = $(this).data("productid");
            $.get("/cart/reduceProduct/"+productId,function(data){
                console.log(data);
                $(".cart-reload").load("/product .shopping-item");
                $("form.shop_form").load("/cart table.shop_table");
                $(".cart_totals").load("/cart .shop_total");
            });

        });

        $(".woocommerce").on("click",".removeItem",function(){
            var productId = $(this).data("productid");
            $.get("/cart/removeItem/"+productId,function(data){
                console.log(data);
                $(".cart-reload").load("/product .shopping-item");
                $("form.shop_form").load("/cart table.shop_table");
                $(".cart_totals").load("/cart .shop_total");
            });

        });

        $(".woocommerce").on("click",".plusItem",function(){
            var productId = $(this).data("productid");
            $.get("/cart/plusProduct/"+productId,function(data){
                console.log(data);
                $(".cart-reload").load("/product .shopping-item");
                $("form.shop_form").load("/cart table.shop_table");
                $(".cart_totals").load("/cart .shop_total");
            });

        });
    });
</script>
@endsection
