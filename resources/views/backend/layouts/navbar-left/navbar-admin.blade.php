<nav class="pcoded-navbar">
    <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
    <div class="pcoded-inner-navbar main-menu">
        <div class="">
            <div class="main-menu-header">
                <img class="img-80 img-radius" src="assets/images/avatar-4.jpg" alt="User-Profile-Image">
                <div class="user-details">
                    <span id="more-details">{{Auth::guard('admin')->user()->name}} {{Auth::guard('admin')->user()->surname}}<i class="fa fa-caret-down"></i></span>
                </div>
            </div>

            <div class="main-menu-content">
                <ul>
                    <li class="more-details">
                        <a href="#"><i class="ti-settings"></i>ตั้งค่า</a>
                        <a href="#"><i class="ti-user"></i>ข้อมูลส่วนตัว</a>
                        <a href="#"><i class="ti-bell"></i>ข้อความแจ้งเตือน</a>
                        @if(Auth::guard('admin')->user() != NULL)
                            <a href="{{ route('admin.logout') }}" 
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <i class="ti-lock"></i>
                                ออกจากระบบ
                            </a>
                            <form id="logout-form" action="{{ 'App\Admin' == Auth::getProvider()->getModel() ? route('admin.logout') : route('admin.logout') }}" method="POST" style="display: none;">
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
                    <span class="pcoded-micon"><i class="ti-user"></i></span>
                    <span class="pcoded-mtext"  data-i18n="nav.basic-components.main">ตัวจัดการบัญชี</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="pcoded-hasmenu">
                        <a href="javascript:void(0)" class="waves-effect waves-dark">
                            <span class="pcoded-mtext"  data-i18n="nav.basic-components.main">บัญชีของลูกค้า</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                        <ul class="pcoded-submenu">
                            <li class=" ">
                                <a href="{{url('/admin/data-of-customer')}}" class="waves-effect waves-dark">
                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">ข้อมูลลูกค้า</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class=" ">
                        <a href="{{url('/admin/manage-member-store')}}" class="waves-effect waves-dark">
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">บัญชีของสมาชิกร้านค้า</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="{{url('/admin/manage-seller')}}" class="waves-effect waves-dark">
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">บัญชีของพนักงานขาย</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-agenda"></i></span>
                    <span class="pcoded-mtext"  data-i18n="nav.basic-components.main">การรับประกันสินค้า</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li class=" ">
                        <a href="{{url('/admin/data-warranty')}}" class="waves-effect waves-dark">
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">ข้อมูลการลงทะเบียน</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="#" class="waves-effect waves-dark">
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
                        <a href="{{url('/admin/upload-product-form')}}" class="waves-effect waves-dark">
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">อัพโหลดสินค้า</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="{{url('/admin/list-product')}}" class="waves-effect waves-dark">
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">รายการสินค้าทั้งหมด</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="{{url('/admin/list-product-price')}}" class="waves-effect waves-dark">
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">จัดการราคาสินค้า</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="{{url('/admin/manage-film-stock')}}" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-panel"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.form-components.main">ปรับเพิ่ม / ลด สินค้า</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-pie-chart"></i></span>
                    <span class="pcoded-mtext"  data-i18n="nav.basic-components.main">จัดการผลิตภัณฑ์</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li class=" ">
                        <a href="{{url('/admin/manage-category')}}" class="waves-effect waves-dark">
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">ประเภทผลิตภัณฑ์</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="{{url('/admin/manage-film-type')}}" class="waves-effect waves-dark">
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">ประเภทฟิล์ม</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="{{url('/admin/manage-brand')}}" class="waves-effect waves-dark">
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">ยี่ห้อโทรศัพท์</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="{{url('/admin/manage-phone-model')}}" class="waves-effect waves-dark">
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">รุ่นโทรศัพท์</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="{{url('/admin/serialnumber')}}" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="fa fa-sort-numeric-asc"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.form-components.main">สร้างหมายเลขสินค้า</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
        </ul>

        <div class="pcoded-navigation-label" data-i18n="nav.category.other">จัดการ Order การสั่งซื้อ</div>
        <ul class="pcoded-item pcoded-left-item">
            <li>
                <a href="{{url('/admin/product-out')}}" class="waves-effect waves-dark">
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
                            <li class="">
                                <a href="javascript:void(0)" class="waves-effect waves-dark">
                                    <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.menu-level-31">การสั่งซื้อของลูกค้า</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                        </ul>
                        <ul class="pcoded-submenu">
                            <li class="">
                                <a href="javascript:void(0)" class="waves-effect waves-dark">
                                    <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.menu-level-31">การสั่งซื้อของร้านค้า</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="pcoded-hasmenu ">
                        <a href="javascript:void(0)" class="waves-effect waves-dark">
                            <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.main">ข้อมูลการชำระเงิน</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                        <ul class="pcoded-submenu">
                            <li class="">
                                <a href="javascript:void(0)" class="waves-effect waves-dark">
                                    <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.menu-level-31">การชำระเงินของลูกค้า</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                        </ul>
                        <ul class="pcoded-submenu">
                            <li class="">
                                <a href="javascript:void(0)" class="waves-effect waves-dark">
                                    <span class="pcoded-mtext" data-i18n="nav.menu-levels.menu-level-22.menu-level-31">การชำระเงินของร้านค้า</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </li>
        </ul>

        <div class="pcoded-navigation-label" data-i18n="nav.category.forms">ตัวจัดการเว็บไซต์</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-image"></i></span>
                    <span class="pcoded-mtext"  data-i18n="nav.basic-components.main">จัดการรูปภาพเว็บไซต์</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li class=" ">
                        <a href="{{url('/admin/manage-image-website')}}" class="waves-effect waves-dark">
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">โลโก้ และสไลด์หลัก</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="{{url('/admin/manage-promotion')}}" class="waves-effect waves-dark">
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">โปรโมชั่นสินค้า</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="{{url('/admin/manage-film-information')}}" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="fa fa-folder-open"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.form-components.main">ข้อมูลและคุณสมบัติสินค้า</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
        </ul>

        <div class="pcoded-navigation-label" data-i18n="nav.category.forms">การติดต่อสอบถาม</div>
        <ul class="pcoded-item pcoded-left-item">
            <li>
                <a href="{{url('/admin/message-customer')}}" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-email"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.form-components.main">การสอบถามของลูกค้า</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            <li>
                <a href="#" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-email"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.form-components.main">การสอบถามของร้านค้า</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>

        </ul>

        
    </div>
</nav>