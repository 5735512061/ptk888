@extends("/frontend/layouts/template/template")

@section("content")
<div class="container-fluid">
    <center><h2>ข้อมูลการรับประกัน<hr class="col-md-1 col-1" style="border-top:5px solid rgb(255 194 49 / 47%)"></h2></center>
</div><br>
<div class="login">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <center><h3>กรุณาลงทะเบียนรับประกันฟิล์ม <strong style="color: #ffc12e;">ภายใน 1-7 วัน</strong> หลังจากที่ซื้อสินค้า กรณีไม่ได้ลงทะเบียนประกัน บริษัทฯ ขอสงวนสิทธิในการเคลมสินค้า</h3></center>
                <div class="register-form">
                    <h4>เงื่อนไขการรับประกัน</h4><hr>
                    <p><i class="fa fa-caret-right"></i> สินค้ายี่ห้อ Madam Film รับประกัน 365 วัน ทุกกรณี นับจากวันที่ซื้อสินค้า</p> 
                    <p><i class="fa fa-caret-right"></i> สินค้ายี่ห้อ Dora Shield รับประกัน 60 วัน ทุกกรณี นับจากวันที่ซื้อสินค้า </p> 
                    <p><i class="fa fa-caret-right"></i> รับประกันฟิล์มไฮโดรเจล 1 ชิ้น / ใบรับประกัน เพียง 1 ครั้งเท่านั้น</p>
                    <p><i class="fa fa-caret-right"></i> กรุณาลงทะเบียนรับประกันสินค้า ภายใน 7 วัน นับจากวันที่ซื้อสินค้า</p>
                    <p><i class="fa fa-caret-right"></i> ในกรณีไม่ได้ลงทะเบียนประกัน บริษัทฯ ขอสงวนสิทธิในการเคลมสินค้า</p>
                    <p><i class="fa fa-caret-right"></i> ไม่สามารถรับคืนหรือเปลี่ยนสินค้าได้ ในกรณีที่เกิดความเสียหายในระหว่างขั้นตอนการติดตั้งที่ไม่ถูกวิธี</p>
                    <br><h4>วิธีการเคลมสินค้า</h4><hr>
                    <p><i class="fa fa-caret-right"></i> ลงทะเบียนรับประกันสินค้าผ่านเว็บไซต์</p>
                    <p><i class="fa fa-caret-right"></i> สามารถแจ้งเคลมสินค้าได้ที่ <a href="{{url('/member/claim-product')}}">ใช้สิทธิ์เคลมสินค้า</a></p>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
</div>
@endsection