@extends("/frontend/layouts/template/template")
<link rel="stylesheet" type="text/css" href="{{ asset('css/dealer-shop  .css')}}">
@section("content")
<div class="container">
    @foreach ($stores as $store => $value)
    <div class="card" style="margin-bottom: 2rem;">
        <div class="container-fliud">
            <div class="wrapper row">
                <div class="preview col-md-6">
                    <div class="preview-pic tab-content">
                        <div class="tab-pane active">
                            <img src="{{url('/image_upload/image_logo_store')}}/{{$value->image_logo}}" class="img-responsive" width="100%"/>
                        </div>
                    </div>
                </div>
                <div class="details col-md-6">
                    <h4 class="product-title">ตัวแทนจำหน่าย {{$value->name}}</h4>
                    <p><strong>ที่อยู่</strong> {{$value->address}}</p>
                    <p><strong>เบอร์โทรศัพท์</strong> {{$value->phone}}</p>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection