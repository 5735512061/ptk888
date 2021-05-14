@extends("/frontend/layouts/template/template")

@section("content")
<div class="container-fluid">
    <center><h2>@lang('warrantyInformation.cliam_product')<hr class="col-md-1 col-1" style="border-top:5px solid rgb(255 194 49 / 47%)"></h2></center>
</div><br>
<div class="login">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="register-form">
                    <form action="{{url('member/claim-product-confirm')}}" enctype="multipart/form-data" method="post">@csrf
                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                            @if(Session::has('alert-' . $msg))
                                <p class="alertdesign alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                            @endif
                        @endforeach
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label"></label>

                            <div class="col-md-6">
                                @if ($errors->has('phone'))
                                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('phone') }})</span>
                                @endif
                                <input type="text" class="phone_format form-control" name="phone" value="{{ old('phone') }}" placeholder="กรอกเบอร์โทรศัพท์ เพื่อตรวจสอบข้อมูลการลงทะเบียน">
                            </div>

                            <div class="col-md-3">
                                <button type="submit" class="btn">
                                    {{ __('ตรวจสอบข้อมูล') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    <h4>@lang('warrantyInformation.condition')</h4><hr>
                    <p><i class="fa fa-caret-right"></i> @lang('warrantyInformation.condition_1')</p> 
                    <p><i class="fa fa-caret-right"></i> @lang('warrantyInformation.condition_2')</p> 
                    <p><i class="fa fa-caret-right"></i> @lang('warrantyInformation.condition_3')</p>
                    <p><i class="fa fa-caret-right"></i> @lang('warrantyInformation.condition_4')</p>
                    <p><i class="fa fa-caret-right"></i> @lang('warrantyInformation.condition_5')</p>
                    <p><i class="fa fa-caret-right"></i> @lang('warrantyInformation.condition_6')</p>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
</div>
@endsection
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