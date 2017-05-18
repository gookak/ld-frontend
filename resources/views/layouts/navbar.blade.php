<div class="container">
    <div class="row">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div> 
        <div class="navbar-collapse collapse" id="navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                <li><a href="/">Home</a></li>
                <li><a href="/product?category_id=1">Product</a></li>
            </ul>
            
            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if(Session::has('cart'))
                <li>
                    <a href="/cart">ตระกร้า&nbsp;&nbsp;
                        @if(Session::has('cart'))
                            <span class="shoppingcart" >
                                <span class="badge alert-info cart-item">
                                    {{Session::get('cart')->totalQty}}
                                </span>
                            </span>
                        @endif
                    </a>
                </li>
                @endif
                @if (Auth::guest())
                <li><a href="{{ route('login') }}"><i class="fa fa-key"></i> Login</a></li>
                <li><a href="{{ route('register') }}"><i class="fa fa-users"></i> Register</a></li>
                @else
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle open-menu" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{ Auth::user()->firstname }} <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="/profile" style="padding: 3px 20px;">
                                <i class="fa fa-user"></i> Profile
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}" style="padding: 3px 20px;" 
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <i class="fa fa-power-off"></i> Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
                @endif
            </ul>
        </div>
    </div>  
</div>
