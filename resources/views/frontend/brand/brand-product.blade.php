@extends("/frontend/layouts/template/template")

@section("content")
{{-- <div class="container-fluid" style="margin-top: 3rem;">
    @foreach ($phone_models as $phone_model => $value)
        @php
           $brand = DB::table('brands')->where('id',$value->brand_id)->value('brand');
        @endphp
        <a href="{{url('/product')}}/{{$brand}}/{{$value->model}}" class="btn btn-info">{{$value->model}}</a>
    @endforeach
</div> --}}

<div class="container-fluid" style="margin-top: 3rem;">
    <div class="row">
        @foreach ($phone_models as $phone_model => $value)
            @php
            $brand = DB::table('brands')->where('id',$value->brand_id)->value('brand');
            @endphp
            <div class="col-md-2" style="margin-bottom: 4rem; border-left: 1px #000 solid;">
                <a style="color: #000;" href="{{url('/product')}}/{{$brand}}/{{$value->model}}">{{$value->model}}</a>   
            </div>
        @endforeach
    </div>
</div>

@endsection