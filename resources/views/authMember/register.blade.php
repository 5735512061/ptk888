@extends("/frontend/layouts/template/template-login")

@section('content')
<!-- Login Start -->
<div class="login">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-6">    
                <div class="register-form">
                    <h3>@lang('registerMember.register_member')</h3><hr>
                    <form action="{{url('/register-member')}}" enctype="multipart/form-data" method="post">@csrf
                        <div class="flash-message">
                            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                              @if(Session::has('alert-' . $msg))
        
                              <p style="font-size: 16px;" class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                              @endif
                            @endforeach
                        </div>
                        @php
                            $random = rand(111111,999999);  
                            $random_format = wordwrap($random , 4 , '-' , true );
                            $id = 'PTK-M-'.$random_format;
                            
                            $member_id = DB::table('members')->where('member_id',$id)->value('member_id');
                                if($member_id == null) {
                                    $id_gen = $id;
                                } else {
                                    $random = rand(111111,999999);  
                                    $random_format = wordwrap($random , 4 , '-' , true );
                                    $id_gen = 'PTK-M-'.$random_format;
                                }
                        @endphp     
                        <div class="form-group row">
                            <div class="col-md-6">
                                <input type="hidden" class="form-control" name="member_id" value="{{$id_gen}}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">@lang('registerMember.first_name')</label>

                            <div class="col-md-6">
                                @if ($errors->has('name'))
                                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('name') }})</span>
                                @endif
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">@lang('registerMember.last_name')</label>

                            <div class="col-md-6">
                                @if ($errors->has('surname'))
                                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('surname') }})</span>
                                @endif
                                <input type="text" class="form-control" name="surname" value="{{ old('surname') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">@lang('registerMember.mobile')</label>

                            <div class="col-md-6">
                                @if ($errors->has('phone'))
                                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('phone') }})</span>
                                @endif
                                <input type="text" class="phone_format form-control" name="phone" value="{{ old('phone') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">@lang('registerMember.address')</label>
                            <div class="col-md-6">
                                @if ($errors->has('address'))
                                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('address') }})</span>
                                @endif
                                <input class="form-control" type="text" placeholder="@lang('placeholder.address')" name="address">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">@lang('registerMember.sub_district')</label>
                            <div class="col-md-6">
                                @if ($errors->has('district'))
                                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('district') }})</span>
                                @endif
                                <input class="form-control" type="text" placeholder="@lang('placeholder.subDistrict')" name="district">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">@lang('registerMember.district')</label>
                            <div class="col-md-6">
                                @if ($errors->has('amphoe'))
                                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('amphoe') }})</span>
                                @endif
                                <input class="form-control" type="text" placeholder="@lang('placeholder.district')" name="amphoe">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">@lang('registerMember.province')</label>
                            <div class="col-md-6">
                                @if ($errors->has('province'))
                                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('province') }})</span>
                                @endif
                                <input class="form-control" type="text" placeholder="@lang('placeholder.province')" name="province">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">@lang('registerMember.zipcode')</label>
                            <div class="col-md-6">
                                @if ($errors->has('zipcode'))
                                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('zipcode') }})</span>
                                @endif
                                <input class="form-control" type="text" placeholder="@lang('placeholder.zipcode')" name="zipcode">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">@lang('registerMember.username')</label>

                            <div class="col-md-6">
                                @if ($errors->has('username'))
                                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('username') }})</span>
                                @endif
                                <input type="text" class="form-control" name="username" value="{{ old('username') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">@lang('registerMember.password')</label>

                            <div class="col-md-6">
                                @if ($errors->has('password'))
                                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('password') }})</span>
                                @endif
                                <input id="password" type="password" class="form-control" name="password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">@lang('registerMember.confirm_password')</label>

                            <div class="col-md-6">
                                @if ($errors->has('password_confirmation'))
                                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('password_confirmation') }})</span>
                                @endif
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn">
                                    @lang('registerMember.submit')
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
