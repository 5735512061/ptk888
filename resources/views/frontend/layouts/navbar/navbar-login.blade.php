<!-- Top bar Start -->
<div class="top-bar">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6"></div>
            <div class="col-sm-6">
                @if(Auth::guard('member')->user() == NULL)
                    <a href="{{url('/register-member')}}">สมัครสมาชิก</a> / <a href="{{url('/member/login')}}">เข้าสู่ระบบ</a>
                @endif
                @if(Auth::guard('member')->user() != NULL)
                    สวัสดี! {{Auth::guard('member')->user()->name}} {{Auth::guard('member')->user()->surname}}<br>
                    <a href="{{url('/member/profile')}}">บัญชีสมาชิก</a> <a style="border-right: 3px solid rgba(0, 0, 0, 0.527) !important; margin-right:5px;"></a> <a href="{{ route('member.logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    ออกจากระบบ
                    </a>
                    <form id="logout-form" action="{{ 'App\Member' == Auth::getProvider()->getModel() ? route('member.logout') : route('member.logout') }}" method="POST" style="display: none;">@csrf</form>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- Top bar End -->

<!-- Nav Bar Start -->
<div class="nav">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-md bg-dark navbar-dark">
            <a href="#" class="navbar-brand">MENU</a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            @php
                $categorys = DB::table('categorys')->get();
                $brands = DB::table('brands')->paginate('7');
            @endphp
            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav mr-auto">
                    <a href="{{url('/')}}" class="nav-item nav-link">หน้าหลัก</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" style="color: #000 !important;">ผลิตภัณฑ์</a>
                        <div class="dropdown-menu">
                            @foreach ($categorys as $category => $value)
                                <a href="{{url('/category')}}/{{$value->category_eng}}" class="dropdown-item">{{$value->category}}</a>
                            @endforeach
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" style="color: #000 !important;">สินค้าตามรุ่นมือถือ</a>
                        <div class="dropdown-menu">
                            @foreach ($brands as $brand => $value)
                                <a href="{{url('/brand')}}/{{$value->brand_eng}}" class="dropdown-item">{{$value->brand_eng}}</a>
                            @endforeach
                                <a href="{{url('/brand')}}" class="dropdown-item">All Brand</a>
                        </div>
                    </div>
                    <a href="{{url('/dealer-shop')}}" class="nav-item nav-link">ตัวแทนจำหน่าย</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" style="color: #000 !important;">ศูนย์ช่วยเหลือ</a>
                        <div class="dropdown-menu">
                            <a href="{{url('/warranty-information')}}" class="dropdown-item">ข้อมูลการรับประกัน</a>
                            <a href="{{url('/howto-install')}}" class="dropdown-item">วิธีติดตั้ง</a>
                            <a href="{{url('/faq')}}" class="dropdown-item">FAQ</a>
                        </div>
                    </div>
                    <a href="{{url('/promotion')}}" class="nav-item nav-link">โปรโมชั่น</a>
                    <a href="{{url('/about-us')}}" class="nav-item nav-link">เกี่ยวกับเรา</a>
                    <a href="{{url('/contact-us')}}" class="nav-item nav-link">ติดต่อเรา</a>
                </div>
                <a id="desktop" href="{{url('/member/register-warranty')}}" class="nav-item nav-link" style="background-color: #ff8930; color:#fff;">ลงทะเบียนรับประกันฟิล์ม</a>
            </div>
        </nav>
    </div>
</div><hr style="margin-top: 0px; margin-bottom: 0px;">
<!-- Nav Bar End -->        