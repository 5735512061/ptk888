@extends("/frontend/layouts/template/template")

@section("content")
<!-- Contact Start -->
<div class="contact">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="contact-info">
                    <h2>ติดต่อเรา</h2>
                    <h3><i class="fa fa-map-marker"></i>123 Office, Los Angeles, CA, USA</h3>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="contact-info">
                    <h2>ติดต่อเรา</h2>
                    <h3><i class="fa fa-envelope"></i>ptkstudio8@gmail.com</h3>
                    <h3><i class="fa fa-phone"></i>066-113-1689</h3>
                    <div class="social">
                        <a href=""><i class="fab fa-facebook-f"></i></a>
                        <a href=""><i class="fab fa-line"></i></a>
                        <a href=""><i class="fab fa-instagram"></i></a>
                        <a href=""><i class="fab fa fa-envelope"></i></a>
                        <a href=""><i class="fab fa fa-phone"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="contact-form">
                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="ชื่อ-นานมสกุลผู้ติดต่อ" />
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="เบอร์โทรศัพท์" />
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="หัวข้อเรื่อง" />
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" rows="5" placeholder="ข้อความที่ต้องการติดต่อ"></textarea>
                        </div>
                        <div><button class="btn" type="submit">ส่งข้อความติดต่อ</button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->
@endsection