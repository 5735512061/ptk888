<style>
    @media only screen and (max-width: 768px) {
        #mobile {
          display: inline !important;
        }
        #desktop {
          display: none;
        }
    }
    </style>
<!-- Top bar Start -->
<div class="top-bar">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6"></div>
            <div class="col-sm-6">
                <a href="{{url('/register-member')}}">สมัครสมาชิก</a> / <a href="{{url('/member/login')}}">เข้าสู่ระบบ</a>
            </div>
        </div>
    </div>
</div><hr style="margin-top: 0px; margin-bottom: 0px;">
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
                $brands = DB::table('brands')->get();
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
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" style="color: #000 !important;">ยี่ห้อสินค้า</a>
                        <div class="dropdown-menu">
                            @foreach ($brands as $brand => $value)
                                <a href="{{url('/brand')}}/{{$value->brand_eng}}" class="dropdown-item">{{$value->brand_eng}}</a>
                            @endforeach
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
                <a id="desktop" href="{{url('/member/register-warranty')}}" class="nav-item nav-link" style="background-color: #21bdff;">ลงทะเบียนรับประกันฟิล์ม</a>
            </div>
        </nav>
    </div>
</div><hr style="margin-top: 0px; margin-bottom: 0px;">
<!-- Nav Bar End -->      

<!-- Bottom Bar Start -->

<div class="bottom-bar">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-3">
                <div class="logo">
                    <a href="{{url('/')}}">
                        @php
                            $image = DB::table('image_websites')->where('image_type','logo')->value('image');
                        @endphp
                        <img src="{{url('/image_upload/image_website')}}/{{$image}}" class="img-responsive" alt="Logo" width="50%">
                    </a>
                </div>
            </div>
            <div class="col-md-6">
                <center><a id="mobile" style="display: none;" class="btn-warranty" href="{{url('/member/register-warranty')}}">ลงทะเบียนรับประกันฟิล์ม</a><center><br>
            </div>
            <div class="col-md-3">
                <div class="user">
                    <a href="#" class="btn wishlist">
                        <i class="fa fa-heart"></i>
                        <span>(0)</span>
                    </a>
                    <a href="#" class="btn cart">
                        <i class="fa fa-shopping-cart"></i>
                        <span>(0)</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Bottom Bar End -->    