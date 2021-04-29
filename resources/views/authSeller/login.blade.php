@extends("/backend/layouts/template/template-admin-login")
<style>
    .btn:hover{
        color: #fff !important;
        background: #ff882e !important;
    }
    .btn{
        color: #fff !important;
        background: #7b7b7b !important;
        border: 1px solid #fff !important;
    }
</style>
@section('content')
<!-- Login Start -->
<div class="login">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div style="font-size: 6rem; text-align:center; color:#7b7b7b;">
                    <i class="fa fa-lock"></i> <i style="color:#ff882e;" class="fa fa-arrow-right"></i> <i class="fa fa-unlock-alt"></i>
                </div>
                
                <div class="login-form" style="background: #7b7b7b;">
                    <h3 style="color: #fff; font-weight: bold; text-align:center;">เข้าสู่ระบบพนักงานขาย</h3><hr>
                    <form action="{{url('/seller/login')}}" enctype="multipart/form-data" method="post">@csrf
                        @csrf

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right" style="color: #fff; font-weight: bold;">{{ __('รหัสสมาชิก') }}</label>

                            <div class="col-md-6">
                                @if ($errors->has('seller_id'))
                                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('seller_id') }})</span>
                                @endif
                                <input type="text" class="form-control" name="seller_id" value="{{ old('seller_id') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right" style="color: #fff; font-weight: bold;">{{ __('รหัสผ่าน') }}</label>

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
                                    {{ __('เข้าสู่ระบบพนักงานขาย') }}
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
