@extends("/frontend/layouts/template/template")

@section("content")
<!-- Contact Start -->
<div class="contact">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="contact-info">
                    <h2>ติดต่อเรา</h2>
                    <h3><i class="fa fa-map-marker"></i>169/24 หมู่ที่ 3 ตำบลคูคต อำเภอลำลูกกา จังหวัดปทุมธานี 12130 (สาขาใหญ่)</h3>
                    <h3><i class="fa fa-map-marker"></i>25/1 หมู่ที่ 4 ถนนเจ้าฟ้า ตำบลฉลอง อำเภอเมือง จังหวัดภูเก็ต 83130 (สาขาภูเก็ต)</h3>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="contact-info">
                    <h2>ติดต่อเรา</h2>
                    <h3><i class="fa fa-envelope"></i>ptkstudio8@gmail.com</h3>
                    <h3><i class="fa fa-phone"></i>066-113-1689</h3>
                    <div class="social">
                        <a href="https://www.facebook.com/ptkstudio8"><i class="fab fa-facebook-f"></i></a>
                        <a href=""><i class="fab fa-line"></i></a>
                        <a href=""><i class="fab fa-instagram"></i></a>
                        <a href="#" data-toggle="tooltip" data-placement="top" title="ptkstudio8@gmail.com"><i class="fab fa fa-envelope"></i></a>
                        <a href="#" data-toggle="tooltip" data-placement="top" title="066-113-1689"><i class="fab fa fa-phone"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="contact-form">
                    <form action="{{url('member/send-message')}}" enctype="multipart/form-data" method="post">@csrf
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="ชื่อ-นานมสกุลผู้ติดต่อ" name="name"/>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="phone_format form-control" placeholder="เบอร์โทรศัพท์" name="phone"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="หัวข้อเรื่อง" name="subject"/>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" rows="5" placeholder="ข้อความที่ต้องการติดต่อ" name="message"></textarea>
                        </div>
                        @if(Auth::guard('member')->user() != NULL)
                            <input type="hidden" name="customer_id" value="{{Auth::guard('member')->user()->id}}">
                        @endif
                        <div><button class="btn" type="submit">ส่งข้อความติดต่อ</button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->
<script type="text/javascript" src="{{asset('https://code.jquery.com/jquery-3.2.1.min.js')}}"></script>
<script>
   // number phone
   function phoneFormatter() {
        $('input.phone_format').on('input', function() {
            var number = $(this).val().replace(/[^\d]/g, '')
                if (number.length >= 5 && number.length < 10) { number = number.replace(/(\d{3})(\d{2})/, "$1-$2"); } else if (number.length >= 10) {
                    number = number.replace(/(\d{3})(\d{3})(\d{3})/, "$1-$2-$3"); 
                }
            $(this).val(number)
            $('input.phone_format').attr({ maxLength : 12 });    
        });
    };
    $(phoneFormatter);
</script>
@endsection