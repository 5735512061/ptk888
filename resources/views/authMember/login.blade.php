@extends("/frontend/layouts/template/template-login")

@section('content')
<!-- Login Start -->
<div class="login">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="login-form">
                    <h3>@lang('loginMember.member_login')</h3><hr>
                    <form action="{{url('/member/login')}}" enctype="multipart/form-data" method="post">@csrf
                        @csrf
                        <div class="flash-message">
                            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                              @if(Session::has('alert-' . $msg))
        
                              <p style="font-size: 16px;" class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                              @endif
                            @endforeach
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">@lang('loginMember.username')</label>

                            <div class="col-md-6">
                                @if ($errors->has('username'))
                                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('username') }})</span>
                                @endif
                                <input type="text" class="form-control" name="username" value="{{ old('username') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">@lang('loginMember.password')</label>

                            <div class="col-md-6">
                                @if ($errors->has('password'))
                                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('password') }})</span>
                                @endif
                                <input id="password" type="password" class="form-control" name="password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <p style="color:#ff8930;">@lang('loginMember.condition')</p>
                                <button type="submit" class="btn">
                                    @lang('loginMember.login')
                                </button>
                                <a href="{{url('/register-member')}}" class="btn cart">@lang('loginMember.register')</a>
                                
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <br><a href="{{url('/member/ForgetPassword')}}">@lang('loginMember.forgot_password')</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Login End -->
@endsection
