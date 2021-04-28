@extends("/frontend/layouts/template/template")

@section("content")
<div class="container-fluid" style="margin-top: 3rem;">
    <div class="row">
        @foreach ($brands as $brand => $value)
            <a class="col-md-3" style="color: #000;" href="{{url('/brand')}}/{{$value->brand}}">
                <div style="margin-bottom: 2rem; background-color:#eeeeee; margin-right:10px; margin-left:10px; height:100px;">
                    <p style="font-size: 25px; text-align:center; font-weight:bold; padding-top:30px;">{{$value->brand}} </p>
                </div>
            </a>  
        @endforeach
    </div>
</div>

@endsection