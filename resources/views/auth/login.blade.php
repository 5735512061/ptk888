@extends("/backend/layouts/template/template-admin-login")

@section('content')
<!-- Login Start -->
<div class="login">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div style="font-size: 6rem; text-align:center; color:#bdbdbda6;">
                    <i class="fa fa-lock"></i> <i class="fa fa-arrow-right"></i> <i class="fa fa-unlock-alt"></i>
                </div>
                
                <div class="login-form">
                    <h3>เข้าสู่ระบบแอดมิน</h3><hr>
                    <form action="{{url('/admin/login')}}" enctype="multipart/form-data" method="post">@csrf
                        @csrf
                        <div class="flash-message">
                            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                              @if(Session::has('alert-' . $msg))
        
                              <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                              @endif
                            @endforeach
                        </div>  
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('ชื่อเข้าใช้งาน') }}</label>

                            <div class="col-md-6">
                                @if ($errors->has('username'))
                                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('username') }})</span>
                                @endif
                                <input type="text" class="form-control" name="username" value="{{ old('username') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('รหัสผ่าน') }}</label>

                            <div class="col-md-6">
                                @if ($errors->has('password'))
                                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('password') }})</span>
                                @endif
                                <input id="password" type="password" class="form-control" name="password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn">
                                    {{ __('เข้าสู่ระบบแอดมิน') }}
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
@endsection
