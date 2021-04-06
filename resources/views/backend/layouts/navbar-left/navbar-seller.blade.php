<nav class="pcoded-navbar">
    <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
    <div class="pcoded-inner-navbar main-menu">
        <div class="">
            <div class="main-menu-header">
                <img class="img-80 img-radius" src="{{url('img/logo_user/user.png')}}">
                <div class="user-details">
                    <span id="more-details">{{Auth::guard('seller')->user()->name}} {{Auth::guard('seller')->user()->surname}}<i class="fa fa-caret-down"></i></span>
                </div>
            </div>

            <div class="main-menu-content">
                <ul>
                    <li class="more-details">
                        {{-- <a href="#"><i class="ti-settings"></i>ตั้งค่า</a>
                        <a href="#"><i class="ti-user"></i>ข้อมูลส่วนตัว</a>
                        <a href="#"><i class="ti-bell"></i>ข้อความแจ้งเตือน</a> --}}
                        @if(Auth::guard('seller')->user() != NULL)
                            <a href="{{ route('seller.logout') }}" 
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <i class="ti-lock"></i>
                                ออกจากระบบ
                            </a>
                            <form id="logout-form" action="{{ 'App\Seller' == Auth::getProvider()->getModel() ? route('seller.logout') : route('seller.logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @endif
                    </li>
                </ul>
            </div>
        </div><br>
        <ul class="pcoded-item pcoded-left-item">
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-agenda"></i></span>
                    <span class="pcoded-mtext"  data-i18n="nav.basic-components.main">การรับประกันสินค้า</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li class=" ">
                        <a href="{{url('/seller/data-warranty')}}" class="waves-effect waves-dark">
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">ข้อมูลการลงทะเบียน</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="{{url('/seller/claim-product')}}" class="waves-effect waves-dark">
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">ข้อมูลการเคลมสินค้า</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        <div class="pcoded-navigation-label" data-i18n="nav.category.forms">คลังสินค้า</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-archive"></i></span>
                    <span class="pcoded-mtext"  data-i18n="nav.basic-components.main">จัดการคลังสินค้า</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li class=" ">
                        <a href="{{url('/seller/list-product')}}" class="waves-effect waves-dark">
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">รายการสินค้าทั้งหมด</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="{{url('/seller/list-product-price')}}" class="waves-effect waves-dark">
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">จัดการราคาสินค้า</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="{{url('/seller/manage-film-stock')}}" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-panel"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.form-components.main">ปรับเพิ่ม / ลด สินค้า</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
        </ul>

        <div class="pcoded-navigation-label" data-i18n="nav.category.other">จัดการ Order การสั่งซื้อ</div>
        <ul class="pcoded-item pcoded-left-item">
            <li>
                <a href="{{url('/seller/product-out')}}" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="fa fa-sign-out"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.form-components.main">รายการสินค้าออก</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            <li class="pcoded-hasmenu ">
                <a href="javascript:void(0)" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-shopping-cart"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.menu-levels.main">การสั่งซื้อ</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="pcoded-hasmenu ">
                        <a href="javascript:void(0)" class="waves-effect waves-dark">
                            <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.main">ข้อมูลการสั่งซื้อ</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                        <ul class="pcoded-submenu">
                            <li class=" ">
                                <a href="{{url('/seller/order-customer')}}" class="waves-effect waves-dark">
                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">การสั่งซื้อของลูกค้า</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                        </ul>
                        <ul class="pcoded-submenu">
                            <li class="">
                                <a href="{{url('/seller/order-store')}}" class="waves-effect waves-dark">
                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">การสั่งซื้อของร้านค้า</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
        
    </div>
</nav>