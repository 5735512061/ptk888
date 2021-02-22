@extends("/frontend/layouts/template/template")

@section('content')
<!-- Login Start -->
<div class="login">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">    
                <div class="register-form">
                    <h3>ลงทะเบียนรับประกันฟิล์ม</h3><hr>
                    <form action="{{url('/register-member')}}" enctype="multipart/form-data" method="post">@csrf
                        @csrf

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('ชื่อ') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('นามสกุล') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control{{ $errors->has('surname') ? ' is-invalid' : '' }}" name="surname" value="{{ old('surname') }}" required autofocus>

                                @if ($errors->has('surname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('surname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('เบอร์โทรศัพท์') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" required autofocus>

                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('ประเภทฟิล์มของรุ่นที่ลงทะเบียน') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" required autofocus>

                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('หมายเลขซีเรียล') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" required autofocus>

                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('รุ่นมือถือ') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" required autofocus>

                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('วันที่สั่งซื้อ') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" required autofocus>

                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

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
                    <p><i class="fa fa-caret-right"></i> สินค้ามีการรับประกันคุณภาพของฟิล์ม 3 เดือน นับจากวันที่ซื้อสินค้า </p> 
                    <p><i class="fa fa-caret-right"></i> รับประกันฟิล์มกระจก 1 ชิ้น / ใบรับประกัน เพียง 1 ครั้งเท่านั้น</p>
                    <p><i class="fa fa-caret-right"></i> กรุณาลงทะเบียนรับประกัน ในกรณีไม่ได้ลงทะเบียนประกัน บริษัทฯ ขอสงวนสิทธิในการเคลมสินค้า</p>
                    <p><i class="fa fa-caret-right"></i> ไม่สามารถรับคืนหรือเปลี่ยนสินค้าได้ ในกรณีที่เกิดความเสียหายในระหว่างขั้นตอนการติดตั้งที่ไม่ถูกวิธี</p>
                    <br><h6>วิธีการเคลมสินค้า</h6><hr>
                    <p><i class="fa fa-caret-right"></i> ลงทะเบียนรับประกันฟิล์มออนไลน์ผ่านเว็บไซต์</p>
                    <p><i class="fa fa-caret-right"></i> แจ้งเรื่องผ่านเว็บไซต์ในหัวข้อ <a href="{{url('/contact-us')}}">ติดต่อเรา</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Login End -->
@endsection
