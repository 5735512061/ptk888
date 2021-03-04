@extends("/frontend/layouts/template/template")

@section("content")

    <div class="featured-product product">
        <div class="container-fluid">
            <div class="row align-items-center" style="margin-top: 2rem;">
                @foreach ($products as $product => $value)
                    @php
                        $image = DB::table('image_products')->where('product_id',$value->id)->value('image');
                    @endphp
                    <div class="col-lg-3" style="margin-bottom: 2rem;">
                        <div class="product-item">
                            <div class="product-title">
                                <div class="ratting">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                            </div>
                            @php
                                $brand = DB::table('brands')->where('id',$value->brand_id)->value('brand');
                                $model = DB::table('phone_models')->where('id',$value->phone_model_id)->value('model');
                            @endphp
                            <a href="{{url('/product')}}/{{$brand}}/{{$model}}/detail/{{$value->id}}">
                                <div class="product-image">
                                    <img src="{{url('/image_upload/image_product')}}/{{$image}}" width="100%">
                                </div>
                                <div class="text-intro">
                                    <h5 style="font-weight: bold; padding:1.5rem;">{{$value->product_name}}</h5>
                                </div>
                            </a>
                            <div class="product-price">
                                <h5 style="font-weight: bold; padding-left:0.5rem;">ราคา 790 บาท</h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection