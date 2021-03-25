@extends("/frontend/layouts/template/template-login")

@section("content")
<!-- Login Start -->
<div class="login">
  <div class="container-fluid">
      <div class="row justify-content-center">
          <div class="col-lg-6">
              <div class="login-form">
                  <h3>เปลี่ยนรหัสผ่าน</h3><hr>
                  <form method="POST" action="{{ route('password.update') }}">@csrf
                      @csrf
                      <div class="flash-message">
                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                          @if(Session::has('alert-' . $msg))
    
                          <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                          @endif
                        @endforeach
                      </div>
                      <div class="form-group row">
                          <label class="col-md-4 col-form-label text-md-right">{{ __('รหัสผ่านเก่า') }}</label>

                          <div class="col-md-6">
                            <input id="oldpassword" type="password" class="form-control{{ $errors->has('oldpassword') ? ' is-invalid' : '' }}"  name="oldpassword" required autofocus>
                          </div>
                      </div>

                      <div class="form-group row">
                          <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('รหัสผ่านใหม่') }}</label>

                          <div class="col-md-6">
                            <input id="password" type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required autofocus>
                          </div>
                      </div>

                      <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('ยืนยันรหัสผ่าน') }}</label>

                        <div class="col-md-6">
                          <input id="password-confirm" type="password" name="password_confirmation" class="form-control{{ $errors->has('password-confirm') ? ' is-invalid' : '' }}" required autofocus>
                        </div>
                    </div>

                      <div class="form-group row mb-0">
                          <div class="col-md-8 offset-md-4">
                              <button type="submit" class="btn">
                                  {{ __('เปลี่ยนรหัสผ่าน') }}
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
