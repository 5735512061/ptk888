@extends("/frontend/layouts/template/template")

@section("content")
<div class="container-fluid" style="margin-top: 3rem;">
    <div class="row">
        @foreach ($phone_models as $phone_model => $value)
            @php
            $brand = DB::table('brands')->where('id',$value->brand_id)->value('brand');
            @endphp
            <a class="col-md-3" style="color: #000;" href="{{url('/product')}}/{{$brand}}/{{$value->model}}">
                <div style="margin-bottom: 2rem; background-color:#eeeeee; margin-right:10px; margin-left:10px; height:100px;">
                    <p style="font-size: 25px; text-align:center; font-weight:bold; padding-top:30px;">{{$value->model}} </p>
                </div>
            </a>  
        @endforeach
    </div>
</div>

@endsection