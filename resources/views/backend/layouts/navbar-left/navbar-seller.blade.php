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

            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav mr-auto">
                    <a href="{{url('/')}}" class="nav-item nav-link active">หน้าหลัก</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">ผลิตภัณฑ์</a>
                        <div class="dropdown-menu">
                            <a href="{{url('/product/dealer-shop')}}" class="dropdown-item">ฟิล์มมือถือ</a>
                            <a href="{{url('/product/dealer-shop')}}" class="dropdown-item">ฟิล์มโน๊ตบุ๊ค</a>
                        </div>
                    </div>
                    <a href="{{url('/dealer-shop')}}" class="nav-item nav-link">ตัวแทนจำหน่าย</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">ศูนย์ช่วยเหลือ</a>
                        <div class="dropdown-menu">
                            <a href="{{url('/warranty-information')}}" class="dropdown-item">ข้อมูลการรับประกัน</a>
                            <a href="{{url('/howto-install')}}" class="dropdown-item">วิธีติดตั้ง</a>
                            <a href="{{url('/faq')}}" class="dropdown-item">FAQ</a>
                        </div>
                    </div>
                    <a href="{{url('/about-us')}}" class="nav-item nav-link">เกี่ยวกับเรา</a>
                    <a href="{{url('/contact-us')}}" class="nav-item nav-link">ติดต่อเรา</a>
                </div>
                <a href="{{url('/member/register-warranty')}}" class="nav-item nav-link">ลงทะเบียนรับประกันฟิล์ม</a>
            </div>
        </nav>
    </div>
</div>
<!-- Nav Bar End -->      

<!-- Bottom Bar Start -->
<div class="bottom-bar">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-3">
                <div class="logo">
                    <a href="{{url('/')}}">
                        @php
                            $image = DB::table('image_websites')->where('image_type','รูปภาพโลโก้')->value('image');
                        @endphp
                        <img src="{{url('/image_upload/image_website')}}/{{$image}}" class="img-responsive" alt="Logo" width="100%">
                    </a>
                </div>
            </div>
            <div class="col-md-6">
                {{-- <div class="search">
                    <input type="text" placeholder="Search">
                    <button><i class="fa fa-search"></i></button>
                </div> --}}
            </div>
            <div class="col-md-2">
                <div class="user">
                    <a href="cart.html" class="btn cart">
                        <i class="fa fa-shopping-cart"></i>
                        <span>(0)</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Bottom Bar End -->    