@extends("/frontend/layouts/template/template")

@section("content")
<div class="container-fluid">
    <center><h2>@lang('howtoInstall.installation_steps')<hr width="60px;" style="border-top:5px solid rgb(255 194 49 / 47%)"></h2></center>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="login">
                <div class="register-form">
                    <h5 style="line-height: 1.7;">@lang('howtoInstall.step_1')</h5>
                    <h5 style="line-height: 1.7;">@lang('howtoInstall.step_2')</h5>
                    <h5 style="line-height: 1.7;">@lang('howtoInstall.step_3')</h5>
                    <h5 style="line-height: 1.7;">@lang('howtoInstall.step_4')</h5>
                    <h5 style="line-height: 1.7;">@lang('howtoInstall.step_5')</h5>
                    <h5 style="line-height: 1.7;">@lang('howtoInstall.step_6')</h5>
                </div>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>
</div><br>
@endsection