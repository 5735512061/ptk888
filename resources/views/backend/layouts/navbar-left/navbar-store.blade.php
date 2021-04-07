<nav class="pcoded-navbar">
    <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
    <div class="pcoded-inner-navbar main-menu">
        <div class="">
            <div class="main-menu-header">
                <img class="img-80 img-radius" src="{{url('img/logo_user/user.png')}}">
                <div class="user-details">
                    <span id="more-details">{{Auth::guard('store')->user()->name}} {{Auth::guard('store')->user()->surname}}<i class="fa fa-caret-down"></i></span>
                </div>
            </div>

            <div class="main-menu-content">
                <ul>
                    <li class="more-details">
                        {{-- <a href="#"><i class="ti-settings"></i>ตั้งค่า</a>
                        <a href="#"><i class="ti-user"></i>ข้อมูลส่วนตัว</a>
                        <a href="#"><i class="ti-bell"></i>ข้อความแจ้งเตือน</a> --}}
                        @if(Auth::guard('store')->user() != NULL)
                            <a href="{{ route('store.logout') }}" 
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <i class="ti-lock"></i>
                                ออกจากระบบ
                            </a>
                            <form id="logout-form" action="{{ 'App\store' == Auth::getProvider()->getModel() ? route('store.logout') : route('store.logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @endif
                    </li>
                </ul>
            </div>
        </div><br>
        <div class="pcoded-navigation-label" data-i18n="nav.category.forms">รายการสินค้าออก</div>
        <ul class="pcoded-item pcoded-left-item">
            <li>
                <a href="{{url('/store/product-out')}}" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-panel"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.form-components.main">รายการสินค้าออก</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
        </ul>
        <div class="pcoded-navigation-label" data-i18n="nav.category.forms">การสั่งซื้อสินค้า</div>
        <ul class="pcoded-item pcoded-left-item">
            <li>
                <a href="{{url('/store/order-product')}}" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="fa fa-cart-plus"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.form-components.main">สั่งซื้อสินค้า</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            <li>
                <a href="{{url('/store/shopping-cart')}}" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="fa fa-cart-arrow-down"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.form-components.main">ตะกร้าสินค้า</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            <li>
                <a href="{{url('/store/order-history')}}" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="fa fa-shopping-basket"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.form-components.main">ประวัติการสั่งซื้อ</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
        </ul>
        <div class="pcoded-navigation-label" data-i18n="nav.category.forms">การสั่งซื้อสินค้าพร้อมแพ็คเกจ</div>
        <ul class="pcoded-item pcoded-left-item">
            <li>
                <a href="{{url('/store/order-product/film-brand')}}" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="fa fa-cart-plus"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.form-components.main">สั่งซื้อสินค้าพร้อมแพ็คเกจ</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            <li>
                <a href="{{url('/store/shopping-cart/film-brand')}}" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="fa fa-cart-arrow-down"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.form-components.main">ตะกร้าสินค้าแพ็คเกจ</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            <li>
                <a href="{{url('/store/order-history/film-brand')}}" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="fa fa-shopping-basket"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.form-components.main">ประวัติการสั่งซื้อแพ็คเกจ</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
        </ul>
        <div class="pcoded-navigation-label" data-i18n="nav.category.forms">ติดต่อสอบถาม</div>
        <ul class="pcoded-item pcoded-left-item">
            <li>
                <a href="{{url('/store/contact-us')}}" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="fa fa-envelope-o"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.form-components.main">ติดต่อสอบถาม</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            <li>
                <a href="{{url('/store/message-history')}}" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="fa fa-envelope-open-o"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.form-components.main">ประวัติการติดต่อสอบถาม</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
        </ul>
    </div>
</nav>