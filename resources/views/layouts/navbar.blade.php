{{-- <div class="container"> --}}
    {{-- <div class="row"> --}}
        <div class="navbar-header" style="margin-top: 10px">
            <a style="margin-left: 10px" href="/">
                <img width="65" height="auto" src="{{ asset('logo/logo.svg') }}">
            </a>
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
                <li><a href="/product?category_id=all">สินค้า</a></li>
                <li><a href="/howtoshopping">วิธีการสั่งซื้อ</a></li>
                <li><a href="/contact">ติดต่อเรา</a></li>
            </ul>
            
            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
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
                <!-- Authentication Links -->
                @if (Auth::guest())
                <li><a href="{{ route('login') }}"><i class="fa fa-key"></i> เข้าสู่ระบบ</a></li>
                <li><a href="{{ route('register') }}"><i class="fa fa-users"></i> สมัครสมาชิก</a></li>
                <li class="dropdown">
                    <button type="button" class="dropdown-toggle open-menu menubutton menu-admin" data-toggle="dropdown" role="button" aria-expanded="false"><span class="caret"></span>
                    </button>

                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="http://admin.landdcommerce.com" style="padding: 3px 20px;">
                                <i class="fa fa-cogs fa-fw"></i> ผู้ดูแลระบบ
                            </a>
                        </li>
                    </ul>
                </li>
                @else
                
                <li class="dropdown">
                    <button type="button" class="dropdown-toggle open-menu menubutton" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{ Auth::user()->firstname }} <span class="caret"></span>
                    </button>

                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="/profile" style="padding: 3px 20px;">
                                <i class="fa fa-user fa-fw"></i> ข้อมูลผู้ใช้งาน
                            </a>
                        </li>
                        <li>
                            <a href="/profile/repass" style="padding: 3px 20px;">
                                <i class="fa fa-gear fa-fw"></i> เปลี่ยนรหัสผ่าน
                            </a>
                        </li>
                        <li>
                            <a href="/order" style="padding: 3px 20px;">
                                <i class="fa fa-list fa-fw"></i> ข้อมูลการสั่งซื้อ
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}" style="padding: 3px 20px;" 
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <i class="fa fa-power-off fa-fw"></i> ออกจากระบบ
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
{{-- </div>   --}}
{{-- </div> --}}
