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
                                $price = DB::table('product_prices')->where('product_id',$value->id)->where('status','เปิด')->orderBy('id','desc')->value('price'); 
                                $promotion_price = DB::table('product_promotion_prices')->where('product_id',$value->id)->where('status','เปิด')->orderBy('id','desc')->value('promotion_price'); 
                            @endphp
                            <a href="{{url('/product')}}/{{$brand}}/{{$model}}/detail/{{$value->id}}">
                                <div class="product-image">
                                    <img src="{{url('/image_upload/image_product')}}/{{$image}}" width="100%">
                                </div>
                                <div class="text-intro">
                                    @if(\Session::get('locale') == "th")
                                        <h5 style="font-weight: bold; padding:1.5rem;">{{$value->product_name_th}}</h5>
                                    @elseif(\Session::get('locale') == "en")
                                        <h5 style="font-weight: bold; padding:1.5rem;">{{$value->product_name_en}}</h5>
                                    @endif
                                </div>
                            </a>
                            <div class="product-price">
                                @if($price == null)
                                    <h5 style="font-weight: bold; padding-left:0.5rem; font-size:17px;">@lang('byPhoneModelDetail.amount') 0 @lang('byPhoneModelDetail.thb')</h5>
                                @elseif($promotion_price == null)
                                    <h5 style="font-weight: bold; padding-left:0.5rem; font-size:17px;">@lang('byPhoneModelDetail.amount') {{$price}} @lang('byPhoneModelDetail.thb')</h5>
                                @else 
                                <h5 style="font-weight: bold; padding-left:0.5rem; font-size:17px;"><Del>@lang('byPhoneModelDetail.amount') {{$price}} @lang('byPhoneModelDetail.thb')</Del> @lang('byPhoneModelDetail.reduceTo') {{$promotion_price}} @lang('byPhoneModelDetail.thb')</h5>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection