@extends("/frontend/layouts/template/template-index")

@section("content")
        <!-- Main Slider Start -->
        <div class="container-fluid">
            <div class="header" style="background-color: #fff;">
                <div class="row">
                    <div class="col-md-12">
                        <div class="header-slider normal-slider">
                            @foreach ($images as $image => $value)
                                <div class="header-slider-item">
                                    <img src="{{url('/image_upload/image_website')}}/{{$value->image}}" class="img-responsive" width="100%"/>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div><br>
        <!-- Main Slider End -->      
        
        <!-- Brand Start -->
        @php
            $brands = DB::table('brands')->get();
        @endphp
        <div class="container-fluid">
            <div class="brand">
                <div class="brand-slider">
                    @foreach ($brands as $brand => $value)
                    <a href="{{url('/brand')}}/{{$value->brand_eng}}" style="border-right: 2px solid rgba(0,0,0,36%)">
                        <div class="brand-item">
                            <img src="{{url('/image_upload/image_brand')}}/{{$value->image}}" class="img-responsive" width="50%">
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Brand End -->       
        
        <!-- Featured Product Start -->
        <div class="featured-product product">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-2 col-12 section-header" style="text-align: center;">
                        <h2>@lang('byPhoneModelDetail.recommendProduct')<hr class="col-md-1 col-1" style="border-top:5px solid rgba(0,0,0,36%);"></h2>
                    </div>
                    <div class="col-md-5"></div>
                </div>
                
                <div class="row align-items-center product-slider product-slider-4" style="margin-top: 2rem;">
                    @foreach ($products as $product => $value)
                        <div class="col-lg-3">
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
                                    $image = DB::table('image_products')->where('product_id',$value->id)->value('image');
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
                                        <h5 style="font-weight: bold; padding:1.5rem;">{{$value->product_name}}</h5>
                                    </div>
                                </a>
                                <div class="product-price">
                                    @if($price == null)
                                        <h5 style="font-weight: bold; padding-left:0.5rem;">@lang('byPhoneModelDetail.amount') 0 @lang('byPhoneModelDetail.thb')</h5>
                                    @elseif($promotion_price == null)
                                        <h5 style="font-weight: bold; padding-left:0.5rem;">@lang('byPhoneModelDetail.amount') {{$price}} @lang('byPhoneModelDetail.thb')</h5>
                                    @else 
                                    <h5 style="font-weight: bold; padding-left:0.5rem;"><Del>@lang('byPhoneModelDetail.amount') {{$price}} @lang('byPhoneModelDetail.thb')</Del> @lang('byPhoneModelDetail.reduceTo') {{$promotion_price}} @lang('byPhoneModelDetail.thb')</h5>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Featured Product End -->            
        
        <!-- Recent Product Start -->
        <div class="recent-product product">
            <div class="container-fluid">
                <div class="row">
                    <div class=" col-md-2 col-12 section-header" style="text-align: center;">
                        <h2>@lang('byPhoneModelDetail.newProduct')<hr class="col-md-1 col-1" style="border-top:5px solid rgba(0,0,0,36%);"></h2>
                    </div>
                    <div class="col-md-5"></div>
                </div>
                <div class="row align-items-center">
                    <div class="col-lg-4">
                        <div class="product-item">
                            <div class="product-image">
                                <img src="{{url('img/productNew/productNew1.jpg')}}" alt="Product Image">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="product-item">
                            <div class="product-image">
                                <img src="{{url('img/productNew/productNew2.jpg')}}" alt="Product Image">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="product-item">
                            <div class="product-image">
                                <img src="{{url('img/productNew/productNew3.jpg')}}" alt="Product Image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Recent Product End -->      
@endsection