@extends("/frontend/layouts/template/template")

@section("content")
<div class="container-fluid">
    <center><h2>@lang('warrantyInformation.insurance_information')<hr class="col-md-1 col-1" style="border-top:5px solid rgb(255 194 49 / 47%)"></h2></center>
</div><br>
<div class="login">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <center><h3>@lang('warrantyInformation.condition_message') <strong style="color: #ffc12e;">@lang('warrantyInformation.condition_message_2')</strong> @lang('warrantyInformation.condition_message_3')</h3></center>
                <div class="register-form">
                    <h4>@lang('warrantyInformation.condition')</h4><hr>
                    <p><i class="fa fa-caret-right"></i> @lang('warrantyInformation.condition_1')</p> 
                    <p><i class="fa fa-caret-right"></i> @lang('warrantyInformation.condition_2')</p> 
                    <p><i class="fa fa-caret-right"></i> @lang('warrantyInformation.condition_3')</p>
                    <p><i class="fa fa-caret-right"></i> @lang('warrantyInformation.condition_4')</p>
                    <p><i class="fa fa-caret-right"></i> @lang('warrantyInformation.condition_5')</p>
                    <p><i class="fa fa-caret-right"></i> @lang('warrantyInformation.condition_6')</p>
                    <br><h4>@lang('warrantyInformation.cliam_product')</h4><hr>
                    <p><i class="fa fa-caret-right"></i> @lang('warrantyInformation.register')</p>
                    <p><i class="fa fa-caret-right"></i> @lang('warrantyInformation.claim_1') <a href="{{url('/member/claim-product')}}">@lang('warrantyInformation.claim_2')</a></p>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
</div>
@endsection