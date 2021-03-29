<nav class="pcoded-navbar">
    <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
    <div class="pcoded-inner-navbar main-menu">
        <div class="">
            <div class="main-menu-header">
                <img class="img-80 img-radius" src="assets/images/avatar-4.jpg" alt="User-Profile-Image">
                <div class="user-details">
                    <span id="more-details">{{Auth::guard('store')->user()->name}} {{Auth::guard('store')->user()->surname}}<i class="fa fa-caret-down"></i></span>
                </div>
            </div>

            <div class="main-menu-content">
                <ul>
                    <li class="more-details">
                        <a href="#"><i class="ti-settings"></i>ตั้งค่า</a>
                        <a href="#"><i class="ti-user"></i>ข้อมูลส่วนตัว</a>
                        <a href="#"><i class="ti-bell"></i>ข้อความแจ้งเตือน</a>
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
    </div>
</nav>