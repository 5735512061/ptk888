@extends("/frontend/layouts/template/template-login")

@section('content')
<!-- Login Start -->
<div class="login">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="login-form">
                    <h3>@lang('changePassword.changePassword')</h3><hr>
                    <form method="POST" action="{{ route('password.updateForget') }}">@csrf
                        @csrf
                        <div class="flash-message">
                            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                              @if(Session::has('alert-' . $msg))
        
                              <p style="font-size: 16px;" class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                              @endif
                            @endforeach
                        </div>
                        <input type="hidden" name="phone" value="{{$phone}}">
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">@lang('changePassword.newpassword')</label>

                            <div class="col-md-6">
                                @if ($errors->has('password'))
                                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('password') }})</span>
                                @endif
                                <input type="password" class="form-control" name="password" value="{{ old('password') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <input type="hidden" name="phone" value="{{$phone}}">
                            <label class="col-md-4 col-form-label text-md-right">@lang('changePassword.password_confirmation')</label>

                            <div class="col-md-6">
                                @if ($errors->has('password_confirmation'))
                                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('password_confirmation') }})</span>
                                @endif
                                <input type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn">
                                    @lang('changePassword.changePassword')
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
