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

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('ชื่อ') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" value="{{$member->name}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('นามสกุล') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="surname" value="{{$member->surname}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('เบอร์โทรศัพท์') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="phone_format form-control" name="phone" value="{{$member->phone}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('ชื่อเข้าใช้งาน (ภาษาอังกฤษ)') }}</label>

                            <div class="col-md-6">
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
