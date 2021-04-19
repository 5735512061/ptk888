@extends("/frontend/layouts/template/template")

@section('content')
<!-- Login Start -->
<div class="login">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">    
                <div class="register-form">
                    <h3>ลงทะเบียนรับประกันฟิล์ม</h3><hr>
                    <form action="{{url('member/register-warranty')}}" enctype="multipart/form-data" method="post">@csrf
                        @csrf
                        <div class="flash-message">
                            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                @if(Session::has('alert-' . $msg))
                                    <p class="alertdesign alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                                @endif
                            @endforeach
                        </div>
                        <div class="form-group row">
                            
                            <label class="col-md-4 col-form-label text-md-right">{{ __('ชื่อ') }}</label>

                            <div class="col-md-6">
                                @if ($errors->has('name'))
                                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('name') }})</span>
                                @endif
                                <input type="text" class="form-control" name="name" value="{{auth('member')->user()->name}}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('นามสกุล') }}</label>

                            <div class="col-md-6">
                                @if ($errors->has('surname'))
                                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('surname') }})</span>
                                @endif
                                <input type="text" class="form-control" name="surname" value="{{auth('member')->user()->surname}}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('เบอร์โทรศัพท์') }}</label>

                            <div class="col-md-6">
                                @if ($errors->has('phone'))
                                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('phone') }})</span>
                                @endif
                                <input type="text" class="form-control phone_format" name="phone" value="{{auth('member')->user()->phone}}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('ประเภทฟิล์มของรุ่นที่ลงทะเบียน') }}</label>
                            <div class="col-md-6">
                                @if ($errors->has('film_model'))
                                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('film_model') }})</span>
                                @endif
                                <select name="film_model" class="form-control">
                                    <option value="Madam Film">Madam Film</option>
                                    <option value="Dora Shield">Dora Shield</option>
                                    <option value="บูธ PTK888">บูธ PTK888</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('หมายเลขซีเรียล 16 หลัก') }}</label>

                            <div class="col-md-6">
                                @if ($errors->has('serialnumber'))
                                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('serialnumber') }})</span>
                                @endif
                                <input type="text" id="ssn" maxlength="19" minlength="19" class="form-control" name="serialnumber" value="{{ old('serialnumber') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('ยี่ห้อ/รุ่นมือถือ') }}</label>

                            <div class="col-md-6">
                                @if ($errors->has('phone_model'))
                                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('phone_model') }})</span>
                                @endif
                                <input type="text" class="form-control" name="phone_model" value="{{ old('phone_model') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('วันที่สั่งซื้อ') }}</label>

                            <div class="col-md-6">
                                @if ($errors->has('date_order'))
                                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('date_order') }})</span>
                                @endif
                                <input type="text" class="form-control" name="date_order" value="{{ old('date_order') }}" placeholder="ตัวอย่าง เช่น 01/01/2021">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('จุดที่ใช้บริการ') }}</label>
                            <div class="col-md-6">
                                @if ($errors->has('service_point'))
                                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('service_point') }})</span>
                                @endif
                                <select name="service_point" class="form-control">
                                    <option value="ตัวแทนจำหน่าย">ตัวแทนจำหน่าย</option>
                                    <option value="เว็บไซต์ออนไลน์">เว็บไซต์ออนไลน์</option>
                                    <option value="บูธ PTK888">บูธ PTK888</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('สถานที่จุดบริการ') }}</label>

                            <div class="col-md-6">
                                @if ($errors->has('address_service'))
                                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('address_service') }})</span>
                                @endif
                                <input type="text" class="form-control" placeholder="เช่น ร้านติดฟิล์มภูเก็ตหรือร้านค้าออนไลน์" name="address_service" value="{{ old('address_service') }}">
                            </div>
                        </div>
                        <input type="hidden" name="date" id="datepicker">
                        <input type="hidden" name="member_id" value="{{auth('member')->user()->id}}">

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn">
                                    {{ __('ลงทะเบียนรับประกันฟิล์ม') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="register-form">
                    <h6>เงื่อนไขการรับประกัน</h6><hr>
                    <p><i class="fa fa-caret-right"></i> สินค้ายี่ห้อ Madam Film รับประกัน 365 วัน ทุกกรณี นับจากวันที่ซื้อสินค้า</p> 
                    <p><i class="fa fa-caret-right"></i> สินค้ายี่ห้อ Dora Shield รับประกัน 60 วัน ทุกกรณี นับจากวันที่ซื้อสินค้า </p> 
                    <p><i class="fa fa-caret-right"></i> รับประกันฟิล์มไฮโดรเจล 1 ชิ้น / ใบรับประกัน เพียง 1 ครั้งเท่านั้น</p>
                    <p><i class="fa fa-caret-right"></i> กรุณาลงทะเบียนรับประกันสินค้า ภายใน 7 วัน นับจากวันที่ซื้อสินค้า</p>
                    <p><i class="fa fa-caret-right"></i> ในกรณีไม่ได้ลงทะเบียนประกัน บริษัทฯ ขอสงวนสิทธิในการเคลมสินค้า</p>
                    <p><i class="fa fa-caret-right"></i> ไม่สามารถรับคืนหรือเปลี่ยนสินค้าได้ ในกรณีที่เกิดความเสียหายในระหว่างขั้นตอนการติดตั้งที่ไม่ถูกวิธี</p>
                    <br><h6>วิธีการเคลมสินค้า</h6><hr>
                    <p><i class="fa fa-caret-right"></i> ลงทะเบียนรับประกันสินค้าผ่านเว็บไซต์</p>
                    <p><i class="fa fa-caret-right"></i> สามารถแจ้งเคลมสินค้าได้ที่ <a href="{{url('/member/claim-product')}}">ใช้สิทธิ์เคลมสินค้า</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Login End -->
<script type="text/javascript" src="{{asset('https://code.jquery.com/jquery-3.2.1.min.js')}}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.20/js/uikit.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
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
<script>
    // date
    $('#datepicker').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        todayHighlight: true,
    });
    $('#datepicker').datepicker("setDate", new Date());
</script>
<script>
    // serial number
    $('#ssn').keyup(function() {
        var val = this.value.replace(/\D/g, '');
        var newVal = '';
        while (val.length > 4) {
          newVal += val.substr(0, 4) + ' ';
          val = val.substr(4);
        }
        newVal += val;
        this.value = newVal;
    });
</script>
@endsection
