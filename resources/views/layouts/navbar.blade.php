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
                <li><a href="/">หน้าแรก</a></li>
                <li><a href="/product">สินค้า</a></li>
                <li><a href="/">วิธีการสั่งซื้อ</a></li>
                <li><a href="/">ติดต่อเรา</a></li>
            </ul>
            
            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                {{-- @if (Auth::guest()) --}}
                <li>
                    <a href="/cart">ตระกร้า&nbsp;&nbsp;
                        <span class="shoppingcart" >
                            @if(Session::has('cart'))
                            <span class="badge alert-info cart-item">
                                {{Session::get('cart')->totalQty}}
                            </span>
                            @endif
                        </span>
                    </a>
                </li>
                {{-- @endif --}}
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
                                <i class="fa fa-user"></i> ข้อมูลผู้ใช้
                            </a>
                        </li>
                        <li>
                            <a href="/order" style="padding: 3px 20px;">
                                <i class="fa fa-user"></i> ข้อมูลการสั่งซื้อ
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
