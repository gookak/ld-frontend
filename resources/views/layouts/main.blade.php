<!DOCTYPE html>
<!--
	ustora by freshdesignweb.com
	Twitter: https://twitter.com/freshdesignweb
	URL: https://www.freshdesignweb.com/ustora/
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>L&D Com</title>

  <!-- Google Fonts -->
  <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>

  <!-- Bootstrap -->
  <link rel="stylesheet" href="{{ asset('themes/ustora/css/bootstrap.min.css') }}">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('themes/ustora/css/font-awesome.min.css') }}">

  <!-- Css mobile -->
  <link rel="stylesheet" href="{{ asset('themes/ustora/mycustom.css') }}">
  <link rel="stylesheet" href="{{ asset('themes/ustora/css/jquery-ui.css') }}">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="{{ asset('themes/ustora/css/owl.carousel.css') }}">
  <link rel="stylesheet" href="{{ asset('themes/ustora/style.css') }}">
  <link rel="stylesheet" href="{{ asset('themes/ustora/css/responsive.css') }}">
  <link rel="stylesheet" href="{{ asset('themes/ustora/css/colorbox.css') }}">

  <!-- Validator Css-->
  <link rel="stylesheet" href="{{ asset('themes/ustora/css/bootstrapValidator.min.css') }}" />

  @yield('tagheader')

</head>
<body>
    {{-- <div class="header-area">
        @include('layouts.headerarea')
      </div> --}} <!-- End header area -->

      {{-- <div class="site-branding-area">
        <div class="container">
          <div class="row">
                  <div class="col-sm-12">
                    <div class="logo">
                      <h1><a href="/"><img width="120" src="{{ asset('logo/logo.jpg') }}"></a></h1>
                    </div>
                  </div>

                <div class="col-sm-6 cart-reload">
                    @if(Session::has('cart'))
                    <div class="shopping-item">
                        <a href="/cart">Cart - <span class="cart-amunt">{{Session::has('cart') ? Session::get('cart')->totalPrice : '' }}</span> <i class="fa fa-shopping-cart"></i> <span class="product-count">{{Session::has('cart') ? Session::get('cart')->totalQty : '' }}</span></a>
                    </div>
                    @endif
                  </div>
                </div>
              </div>
            </div>  --}}<!-- End site branding area -->

            <div class="mainmenu-area">
              @include('layouts.navbar')
            </div> <!-- End mainmenu area -->

            @yield('content')


            {{-- <div class="footer-top-area">
              <div class="container">
                <div class="row">
                  <div class="col-md-3 col-sm-6">
                    <div class="footer-about-us">
                      <h2><span>L&D Com</span></h2>
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis sunt id doloribus vero quam laborum quas alias dolores blanditiis iusto consequatur, modi aliquid eveniet eligendi iure eaque ipsam iste, pariatur omnis sint! Suscipit, debitis, quisquam. Laborum commodi veritatis magni at?</p>
                    </div>
                  </div>

                  <div class="col-md-3 col-sm-6">
                    <div class="footer-menu">
                      <h2 class="footer-wid-title">User Navigation </h2>
                      <ul>
                        <li><a href="#">My account</a></li>
                        <li><a href="#">Order history</a></li>
                        <li><a href="#">Wishlist</a></li>
                        <li><a href="#">Vendor contact</a></li>
                        <li><a href="#">Front page</a></li>
                      </ul>                        
                    </div>
                  </div>

                  <div class="col-md-3 col-sm-6">
                    <div class="footer-menu">
                      <h2 class="footer-wid-title">Categories</h2>
                      <ul>
                        <li><a href="#">Mobile Phone</a></li>
                        <li><a href="#">Home accesseries</a></li>
                        <li><a href="#">LED TV</a></li>
                        <li><a href="#">Computer</a></li>
                        <li><a href="#">Gadets</a></li>
                      </ul>                        
                    </div>
                  </div>

                  <div class="col-md-3 col-sm-6">
                    <div class="footer-newsletter">
                      <h2 class="footer-wid-title">Newsletter</h2>
                      <p>Sign up to our newsletter and get exclusive deals you wont find anywhere else straight to your inbox!</p>
                      <div class="newsletter-form">
                        <form action="#">
                          <input type="email" placeholder="Type your email">
                          <input type="submit" value="Subscribe">
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div> --}} <!-- End footer top area -->

            <div class="footer-bottom-area">
              <div class="container">
                <div class="row">
                  <div class="col-md-12 text-center">
                    <div class="copyright">
                      <p>Copyright &copy; 2017 L&D Com. All Rights Reserved.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div> <!-- End footer bottom area -->



            <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
            <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->


      <!-- Latest jQuery form server -->
      {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> --}}
      {{-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> --}}
      <script src="{{ asset('themes/ustora/js/jquery-1.11.3.min.js') }}"></script>
      {{-- <script src="{{ asset('js/jquery.js') }}"></script> --}}

      <!-- Bootstrap JS form CDN -->
      <script src="{{ asset('themes/ustora/js/bootstrap.min.js') }}"></script>
      {{-- <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script> --}}

      <!-- jQuery mobile -->
      <script src="{{ asset('themes/ustora/js/jquery-ui.min.js') }}"></script>

      <!-- jQuery sticky menu -->
      <script src="{{ asset('themes/ustora/js/owl.carousel.min.js') }}"></script>
      <script src="{{ asset('themes/ustora/js/jquery.sticky.js') }}"></script>

      <!-- jQuery easing -->
      <script src="{{ asset('themes/ustora/js/jquery.easing.1.3.min.js') }}"></script>

      <!-- Main Script -->
      <script src="{{ asset('themes/ustora/js/main.js') }}"></script>

      <!-- Slider -->
      <script type="text/javascript" src="{{ asset('themes/ustora/js/bxslider.min.js') }}"></script>
      <script type="text/javascript" src="{{ asset('themes/ustora/js/script.slider.js') }}"></script>

      <!-- Validator -->
      <script src="{{ asset('themes/ustora/js/bootstrapValidator.min.js') }}"></script>

      <!-- Cutom.js -->
      <script src="{{ asset('themes/ustora/custom.js') }}"></script>
      <script src="{{ asset('themes/ustora/js/jquery.colorbox-min.js') }}"></script>
      <script src="{{ asset('themes/ustora/js/jquery.dotdotdot.min.js') }}"></script>
      @yield('tagfooter')

      @yield('script')
    </body>
    </html>