@extends("/frontend/layouts/template/template")

@section("content")
<div class="container-fluid">
    <center><h2>@lang('aboutUs.heading')<hr class="col-md-1 col-1" style="border-top:5px solid rgb(255 194 49 / 47%)"></h2></center>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <h5 style="line-height: 1.7;">@lang('aboutUs.detail')</h5>
        </div>
        <div class="col-md-2"></div>
    </div>
</div><br>
@endsection