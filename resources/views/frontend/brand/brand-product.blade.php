@extends("/frontend/layouts/template/template")

@section("content")
<div class="container-fluid" style="margin-top: 3rem;">
    @foreach ($phone_models as $phone_model => $value)
        @php
           $brand = DB::table('brands')->where('id',$value->brand_id)->value('brand');
        @endphp
        <a href="{{url('/product')}}/{{$brand}}/{{$value->model}}" class="btn btn-info">{{$value->model}}</a>
    @endforeach
</div>
@endsection