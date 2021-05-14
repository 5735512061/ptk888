@extends("/frontend/layouts/template/template")

@section("content")
<div class="container">
    @foreach ($stores as $store => $value)
    <div class="card" style="margin-bottom: 2rem;">
        <div class="container-fliud">
            <div class="wrapper row">
                <div class="preview col-md-3">
                    <div class="preview-pic tab-content">
                        <div class="tab-pane active">
                            <img src="{{url('/image_upload/image_logo_store')}}/{{$value->image_logo}}" width="220px;" height="220px;"/>
                        </div>
                    </div>
                </div>
                <div class="details col-md-6">
                    <h4 class="product-title">@lang('dealerShop.agency') {{$value->name}}</h4>
                    <p><strong>@lang('dealerShop.address')</strong> {{$value->address}}</p>
                    <p><strong>@lang('dealerShop.mobile')</strong> {{$value->phone}}</p>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection