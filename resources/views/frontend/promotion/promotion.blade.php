@extends("/frontend/layouts/template/template")

@section("content")
<div class="container-fluid">
    <div class="header" style="background-color: #fff;">
        <div class="row">
            <div class="col-md-12">
                <div class="header-slider normal-slider">
                    @foreach ($promotions as $promotion => $value)
                        <div class="header-slider-item">
                            <img src="{{url('/image_upload/image_promotion')}}/{{$value->image}}" class="img-responsive" width="100%"/>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div><br>
@endsection