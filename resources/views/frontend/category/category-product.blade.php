@extends("/frontend/layouts/template/template")

@section("content")
@if($category_th == "กระจกกันรอย" || $category_th == "หูฟังไร้สาย" || $category_th == "POWER BANK")
    <div class="featured-product product">
        <div class="container-fluid">
            @if($category_th == "กระจกกันรอย")
                <center><h2>@lang('categoryProduct.glassProtect')<hr class="col-md-1 col-1" style="border-top:5px solid rgb(255 194 49 / 47%)"></h2></center>
            @elseif($category_th == "หูฟังไร้สาย")
                <center><h2>@lang('categoryProduct.wirelessHeadphones')<hr class="col-md-1 col-1" style="border-top:5px solid rgb(255 194 49 / 47%)"></h2></center>
            @elseif($category_th == "POWER BANK")
                <center><h2>POWER BANK<hr class="col-md-1 col-1" style="border-top:5px solid rgb(255 194 49 / 47%)"></h2></center>
            @endif
            <h5 style="text-align: center;">-- @lang('categoryProduct.notAvailable') --</h5><hr>
        </div>
    </div>
    <!-- Featured Product Start -->
    <div class="featured-product product">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 col-12 section-header" style="text-align: center;">
                    <h2>@lang('categoryProduct.recommendProducts')<hr class="col-md-1 col-1" style="border-top:5px solid rgba(0,0,0,36%);"></h2>
                </div>
                <div class="col-md-5"></div>
            </div>
            
            <div class="row align-items-center product-slider product-slider-4" style="margin-top: 2rem;">
                @foreach ($productRecommends as $productRecommend => $value)
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
                                    <h5 style="font-weight: bold; padding-left:0.5rem;">@lang('categoryProduct.amount') 0 @lang('categoryProduct.thb')</h5>
                                @else
                                    <h5 style="font-weight: bold; padding-left:0.5rem;">@lang('categoryProduct.amount') {{$price}} @lang('categoryProduct.thb')</h5>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Featured Product End -->
@elseif($category_th == "ฟิล์มไฮโดรเจล")
<div class="featured-product product">
    <div class="container-fluid">
        <center><h2>@lang('categoryProduct.hydrogelProtectorFilm')<hr class="col-md-1 col-1" style="border-top:5px solid rgb(255 194 49 / 47%)"></h2></center>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <h5 style="line-height: 1.7;"><strong>@lang('categoryProduct.hydrogelProtectorFilm')</strong> @lang('categoryProduct.hydrogelProtectorFilm_info')</h5>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
    <div class="container-fluid">
        @php
            $brands = DB::table('brands')->get();
        @endphp
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
        </div><hr>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-5">
                        <img src="{{url('img/logo_film/wolverineSelfRepair.png')}}" class="img-responsive">
                    </div>
                    <div class="col-md-7" style="margin-top: 5em;">
                        <strong>@lang('categoryProduct.wolverineSelfRepairHydrogelFilm')</strong>
                        <p>@lang('categoryProduct.wolverineSelfRepairHydrogelFilm_info')</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-5">
                        <img src="{{url('img/logo_film/privacy.png')}}" class="img-responsive">
                    </div>
                    <div class="col-md-7" style="margin-top: 5em;">
                        <strong>@lang('categoryProduct.privacyScreenHydrogelFilm')</strong>
                        <p>@lang('categoryProduct.privacyScreenHydrogelFilm_info')</p>
                    </div>
                </div>
            </div>
        </div><br>
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-5">
                        <img src="{{url('img/logo_film/antiBlue.png')}}" class="img-responsive">
                    </div>
                    <div class="col-md-7" style="margin-top: 5em;">
                        <strong>@lang('categoryProduct.antiBlueLight')</strong>
                        <p>@lang('categoryProduct.antiBlueLight_info')</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-5">
                        <img src="{{url('img/logo_film/matte.png')}}" class="img-responsive">
                    </div>
                    <div class="col-md-7" style="margin-top: 5em;">
                        <strong>@lang('categoryProduct.hydrogelMatteFilm')</strong>
                        <p>@lang('categoryProduct.hydrogelMatteFilm_info')</p>
                    </div>
                </div>
            </div>
        </div><br>
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-5">
                        <img src="{{url('img/logo_film/high_clear.png')}}" class="img-responsive">
                    </div>
                    <div class="col-md-7" style="margin-top: 5em;">
                        <strong>@lang('categoryProduct.highClearHydrogelFilm')</strong>
                        <p>@lang('categoryProduct.highClearHydrogelFilm_info')</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection