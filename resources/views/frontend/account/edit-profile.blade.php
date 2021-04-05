@extends("/frontend/layouts/template/template-login")

@section('content')
<!-- Login Start -->
<div class="login">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-6">    
                <div class="register-form">
                    <h3>แก้ไขข้อมูลส่วนตัว</h3><hr>
                    <form action="{{url('/member/update-profile')}}" enctype="multipart/form-data" method="post">@csrf    
                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                            @if(Session::has('alert-' . $msg))
                                <p class="alertdesign alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                            @endif
                        @endforeach
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('ชื่อ') }}</label>

                            <div class="col-md-6">
                                @if ($errors->has('name'))
                                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('name') }})</span>
                                @endif
                                <input type="text" class="form-control" name="name" value="{{$member->name}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('นามสกุล') }}</label>

                            <div class="col-md-6">
                                @if ($errors->has('surname'))
                                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('surname') }})</span>
                                @endif
                                <input type="text" class="form-control" name="surname" value="{{$member->surname}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('เบอร์โทรศัพท์') }}</label>

                            <div class="col-md-6">
                                @if ($errors->has('phone'))
                                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('phone') }})</span>
                                @endif
                                <input type="text" class="phone_format form-control" name="phone" value="{{$member->phone}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('ที่อยู่') }}</label>
                            <div class="col-md-6">
                                @if ($errors->has('address'))
                                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('address') }})</span>
                                @endif
                                <input class="form-control" type="text" value="{{$member->address}}" name="address">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('ตำบล') }}</label>
                            <div class="col-md-6">
                                @if ($errors->has('district'))
                                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('district') }})</span>
                                @endif
                                <input class="form-control" type="text" value="{{$member->district}}" name="district">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('อำเภอ') }}</label>
                            <div class="col-md-6">
                                @if ($errors->has('amphoe'))
                                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('amphoe') }})</span>
                                @endif
                                <input class="form-control" type="text" value="{{$member->amphoe}}" name="amphoe">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('จังหวัด') }}</label>
                            <div class="col-md-6">
                                @if ($errors->has('province'))
                                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('province') }})</span>
                                @endif
                                <input class="form-control" type="text" value="{{$member->province}}" name="province">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('รหัสไปรษณีย์') }}</label>
                            <div class="col-md-6">
                                @if ($errors->has('zipcode'))
                                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('zipcode') }})</span>
                                @endif
                                <input class="form-control" type="text" value="{{$member->zipcode}}" name="zipcode">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('ชื่อเข้าใช้งาน (ภาษาอังกฤษ)') }}</label>

                            <div class="col-md-6">
                                @if ($errors->has('username'))
                                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('username') }})</span>
                                @endif
                                <input type="text" class="form-control" name="username" value="{{$member->username}}">
                            </div>
                        </div>
                        <input type="hidden" name="id" value="{{$member->id}}">
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn">
                                    {{ __('อัพเดตข้อมูลส่วนตัว') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Login End -->
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
