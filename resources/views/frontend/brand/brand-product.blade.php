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
            <a class="col-md-2" style="color: #000;" href="{{url('/product')}}/{{$brand}}/{{$value->model}}">
                <div style="margin-bottom: 2rem; background-color:rgb(177, 177, 177); margin-right:10px; margin-left:10px; height:100px;">
                    {{$value->model}} 
                </div>
            </a>  
        @endforeach
    </div>
</div>

@endsection