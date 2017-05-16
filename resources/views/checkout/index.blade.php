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
</div>


<div class="single-product-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-content-right">
                    <div class="woocommerce">
                        <form action="#" class="checkout" method="post" name="checkout">
                            <div id="customer_details" class="col2-set">
                                <div class="col-md-12">
                                    <div class="woocommerce-shipping-fields">
                                        <h3>Check Out</h3>
                                        <div class="shipping_address" style="display: block;">
                                            <div class="form-row form-row-first col-md-6">
                                                <label for="first_name">First Name <abbr title="required" class="required">*</abbr>
                                                </label>
                                                <input type="text" id="first_name" name="first_name" class="input-text ">
                                            </div>

                                            <div class="form-row form-row-last validate-required col-md-6">
                                                <label for="last_name">Last Name <abbr title="required" class="required">*</abbr>
                                                </label>
                                                <input type="text" id="last_name" name="last_name" class="input-text ">
                                            </div>

                                            <div class="form-row form-row-wide col-md-6">
                                                <label for="email">Email <abbr title="required" class="required">*</abbr></label>
                                                <input type="text" id="email" name="email" class="input-text ">
                                            </div>

                                            <div class="form-row form-row-wide col-md-6">
                                                <label for="phone">Phone <abbr title="required" class="required">*</abbr></label>
                                                <input type="text" id="phone" name="phone" class="input-text ">
                                            </div>

                                            <div class="form-row form-row-wide address-field col-md-12">
                                                <label for="address_1">Address <abbr title="required" class="required">*</abbr>
                                                </label>
                                                <textarea cols="5" rows="2" id="address_1" name="address_1" class="input-text "></textarea>
                                            </div>

                                            <div class="form-row form-row-wide address-field col-md-6">
                                                <label for="subdistrict">แขวง <abbr title="required" class="required">*</abbr>
                                                </label>
                                                <input type="text" id="subdistrict" name="subdistrict" class="input-text ">
                                            </div>

                                            <div class="form-row form-row-first address-field col-md-6">
                                                <label for="district">ตำบล <abbr title="required" class="required">*</abbr></label>
                                                <input type="text" id="district" name="district" class="input-text ">
                                            </div>

                                            <div class="form-row form-row-first address-field col-md-6">
                                                <label for="province">จังหวัด <abbr title="required" class="required">*</abbr></label>
                                                <input type="text" id="province" name="province" class="input-text ">
                                            </div>

                                            <div class="form-row form-row-last address-field col-md-6">
                                                <label for="postcode">Postcode <abbr title="required" class="required">*</abbr>
                                                </label>
                                                <input type="text" id="postcode" name="postcode" class="input-text ">
                                            </div>
                                        </div>
                                        </br>
                                        <div class="different_address">
                                            <h3 id="ship-to-different-address">
                                                <label>Ship to a different address?</label>
                                                <input type="checkbox" name="different_address" class="input-checkbox" id="different-address">
                                            </h3>

                                            <div class="form-row form-row-wide address-field col-md-12">
                                                <label for="different_address_1">Address <abbr title="required" class="required">*</abbr>
                                                </label>
                                                <textarea cols="5" rows="2" id="different_address_1" name="different_address_1" class="input-text "></textarea>
                                            </div>

                                            <div class="form-row form-row-wide address-field col-md-6">
                                                <label for="different_subdistrict">แขวง <abbr title="required" class="required">*</abbr>
                                                </label>
                                                <input type="text" id="different_subdistrict" name="different_subdistrict" class="input-text ">
                                            </div>

                                            <div class="form-row form-row-first address-field col-md-6">
                                                <label for="different_district">ตำบล <abbr title="required" class="required">*</abbr></label>
                                                <input type="text" id="different_district" name="different_district" class="input-text ">
                                            </div>

                                            <div class="form-row form-row-first address-field col-md-6">
                                                <label for="different_province">จังหวัด <abbr title="required" class="required">*</abbr></label>
                                                <input type="text" id="different_province" name="different_province" class="input-text ">
                                            </div>

                                            <div class="form-row form-row-last address-field col-md-6">
                                                <label for="different_postcode">Postcode <abbr title="required" class="required">*</abbr>
                                                </label>
                                                <input type="text" id="different_postcode" name="postcode" class="input-text ">
                                            </div>
                                        </div>

                                        <div id="order_comments_field" class="form-row notes col-md-12">
                                            <label class="" for="order_comments">Order Notes</label>
                                            <textarea cols="5" rows="2" placeholder="Notes about your order, e.g. special notes for delivery." id="order_comments" class="input-text " name="order_comments"></textarea>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <h3 id="order_review_heading">Your order</h3>

                            <div id="order_review" style="position: relative;">
                                <table class="shop_table">
                                    <thead>
                                        <tr>
                                            <th class="product-name">Product</th>
                                            <th class="product-total">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    {{-- @foreach($products as $product)
                                        <tr class="cart_item">
                                            <td class="product-name">{{$product['item']['name']}} <strong class="product-quantity">× {{$product['qty']}}</strong> </td>
                                            <td class="product-total">
                                                    <span class="amount">{{$product['price']}}</span> </td>
                                        </tr>
                                        @endforeach --}}
                                    </tbody>
                                    <tfoot>

                                        <tr class="cart-subtotal">
                                            <th>Order Subtotal</th>
                                            <td><span class="amount">{{$totalQty}}</span>
                                            </td>
                                        </tr>
                                        <tr class="order-total">
                                            <th>Total Price</th>
                                            <td><strong><span class="amount">{{$totalPrice}}</span></strong> </td>
                                        </tr>

                                    </tfoot>
                                </table>


                                <div id="payment">
                                    <ul class="payment_methods methods">
                                        <li class="payment_method_bacs">
                                            <input type="radio" data-order_button_text="" checked="checked" value="bacs" name="payment_method" class="input-radio" id="payment_method_bacs">
                                            <label for="payment_method_bacs">Direct Bank Transfer </label>
                                            <div class="payment_box payment_method_bacs">
                                                <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                                            </div>
                                        </li>
                                        <li class="payment_method_cheque">
                                            <input type="radio" data-order_button_text="" value="cheque" name="payment_method" class="input-radio" id="payment_method_cheque">
                                            <label for="payment_method_cheque">Cheque Payment </label>
                                            <div style="display:none;" class="payment_box payment_method_cheque">
                                                <p>Please send your cheque to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>
                                            </div>
                                        </li>
                                        <li class="payment_method_paypal">
                                            <input type="radio" data-order_button_text="Proceed to PayPal" value="paypal" name="payment_method" class="input-radio" id="payment_method_paypal">
                                            <label for="payment_method_paypal">PayPal <img alt="PayPal Acceptance Mark" src="https://www.paypalobjects.com/webstatic/mktg/Logo/AM_mc_vs_ms_ae_UK.png"><a title="What is PayPal?" onclick="javascript:window.open('https://www.paypal.com/gb/webapps/mpp/paypal-popup','WIPaypal','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1060, height=700'); return false;" class="about_paypal" href="https://www.paypal....(line truncated)...
                                            </label>
                                            <div style="display:none;" class="payment_box payment_method_paypal">
                                                <p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account.</p>
                                            </div>
                                        </li>
                                    </ul>

                                    <div class="form-row place-order">

                                        <input type="submit" data-value="Place order" value="Place order" id="place_order" name="woocommerce_checkout_place_order" class="button alt">


                                    </div>

                                    <div class="clear"></div>

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

    });
</script>
@endsection