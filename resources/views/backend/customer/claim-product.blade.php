@extends("/frontend/layouts/template/template")

@section("content")
<div class="container-fluid">
    <center><h2>เคลมสินค้า<hr class="col-md-1 col-1" style="border-top:5px solid rgb(255 194 49 / 47%)"></h2></center>
</div><br>
<div class="login">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="register-form">
                    <form action="{{url('member/claim-product-confirm')}}" enctype="multipart/form-data" method="post">@csrf
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label"></label>

                            <div class="col-md-6">
                                @if ($errors->has('phone'))
                                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('phone') }})</span>
                                @endif
                                <input type="text" class="form-control" name="phone" value="{{ old('phone') }}" placeholder="กรอกเบอร์โทรศัพท์ เพื่อตรวจสอบข้อมูลการลงทะเบียน">
                            </div>

                            <div class="col-md-3">
                                <button type="submit" class="btn">
                                    {{ __('ตรวจสอบข้อมูล') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    <h4>เงื่อนไขการรับประกัน</h4><hr>
                    <p><i class="fa fa-caret-right"></i> สินค้ายี่ห้อ Madam Film รับประกัน 1 ปี ทุกกรณี นับจากวันที่ซื้อสินค้า</p> 
                    <p><i class="fa fa-caret-right"></i> สินค้ายี่ห้อ Dora Shield รับประกัน 3 เดือน ทุกกรณี นับจากวันที่ซื้อสินค้า </p> 
                    <p><i class="fa fa-caret-right"></i> รับประกันฟิล์มไฮโดรเจล 1 ชิ้น / ใบรับประกัน เพียง 1 ครั้งเท่านั้น</p>
                    <p><i class="fa fa-caret-right"></i> กรุณาลงทะเบียนรับประกันสินค้า ภายใน 7 วัน นับจากวันที่ซื้อสินค้า</p>
                    <p><i class="fa fa-caret-right"></i> ในกรณีไม่ได้ลงทะเบียนประกัน บริษัทฯ ขอสงวนสิทธิในการเคลมสินค้า</p>
                    <p><i class="fa fa-caret-right"></i> ไม่สามารถรับคืนหรือเปลี่ยนสินค้าได้ ในกรณีที่เกิดความเสียหายในระหว่างขั้นตอนการติดตั้งที่ไม่ถูกวิธี</p>
                    <br><h4>วิธีการเคลมสินค้า</h4><hr>
                    <p><i class="fa fa-caret-right"></i> ลงทะเบียนรับประกันสินค้าผ่านเว็บไซต์</p>
                    <p><i class="fa fa-caret-right"></i> แจ้งเรื่องผ่านเว็บไซต์ในหัวข้อ <a href="{{url('/member/claim-product')}}">ใช้สิทธิ์เคลมสินค้า</a></p>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
</div>
@endsection