<!-- Footer Start -->
<div class="footer" style="color: #fff;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="logo">
                    <a href="{{url('/')}}">
                        <img src="img/logo.png" alt="Logo">
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="footer-widget">
                    <h2>ศูนย์ช่วยเหลือ</h2>
                    <ul>
                        <li><a href="{{url('/warranty-information')}}">ข้อมูลการรับประกัน</a></li>
                        <li><a href="{{url('/howto-install')}}">วิธีติดตั้ง</a></li>
                        <li><a href="{{url('/faq')}}">FAQ</a></li>
                    </ul>
                </div>
            </div>
            @php
                $categorys = DB::table('categorys')->get();
            @endphp
            <div class="col-lg-3 col-md-6">
                <div class="footer-widget">
                    <h2>ผลิตภัณฑ์</h2>
                    <ul>
                        @foreach ($categorys as $category => $value)
                            <li><a href="{{url('/category')}}/{{$value->category_eng}}">{{$value->category}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="footer-widget">
                    <h2>ตัวแทนจำหน่าย</h2>
                    <ul>
                        <li><a href="{{url('/dealer-shop')}}">ค้นหาร้านค้าตัวแทนจำหน่าย</a></li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="row payment align-items-center">
            <div class="col-md-4"></div>
            <div class="col-md-6">
                <div class="payment-method">
                    <h2>ติดต่อเรา</h2>
                    <div class="social">
                        <a href=""><i class="fab fa-facebook-f"></i></a>
                        <a href=""><i class="fab fa-line"></i></a>
                        <a href=""><i class="fab fa-instagram"></i></a>
                        <a href=""><i class="fab fa fa-envelope"></i></a>
                        <a href=""><i class="fab fa fa-phone"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
</div>
<!-- Footer End -->

<!-- Footer Bottom Start -->
<div class="footer-bottom">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 copyright">
                <p>Copyright &copy; All Rights Reserved</p>
            </div>
        </div>
    </div>
</div>
<!-- Footer Bottom End -->       

<!-- Back to Top -->
<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>