@extends("/frontend/layouts/template/template")

@section("content")
<div class="container-fluid">
    @php
        $image = DB::table('image_products')->where('product_id',$product->id)->value('image');
        $brand = DB::table('brands')->where('id',$product->brand_id)->value('brand');
        $model = DB::table('phone_models')->where('id',$product->phone_model_id)->value('model');
    @endphp
    <div class="featured-product product">
        <div class="container-fluid">
            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                @if(Session::has('alert-' . $msg))
                    <p class="alertdesign alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                @endif
            @endforeach
            <div class="row">
                <div class="col-lg-5" style="margin-bottom: 2rem;">
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
                        <div class="product-image">
                            <img src="{{url('/image_upload/image_product')}}/{{$image}}" width="100%">
                        </div>
                    </div>
                </div>
                @php
                    $price = DB::table('product_prices')->where('product_id',$product->id)->where('status','เปิด')->orderBy('id','desc')->value('price');
                    $promotion_price = DB::table('product_promotion_prices')->where('product_id',$product->id)->orderBy('id','desc')->value('promotion_price');
                @endphp
                
                <div class="col-lg-7">
                    <div class="description">
                        <h4 style="font-weight: bold;">{{$product->product_name}}</h4>
                        @if($price == null)
                            <h4 style="font-weight: bold; color:#FF8930;">@lang('byPhoneModelDetail.amount') 0 @lang('byPhoneModelDetail.thb')</h4><hr>
                        @elseif($promotion_price == null)
                            <h4 style="font-weight: bold; color:#FF8930;">@lang('byPhoneModelDetail.amount') {{$price}} @lang('byPhoneModelDetail.thb')</h4><hr>
                        @else
                            <h4 style="font-weight: bold; color:#FF8930;"><Del>@lang('byPhoneModelDetail.amount') {{$price}} @lang('byPhoneModelDetail.thb')</Del> @lang('byPhoneModelDetail.reduceTo') {{$promotion_price}} @lang('byPhoneModelDetail.thb')</h4><hr>
                        @endif

                        <h5>@lang('byPhoneModelDetail.informationAndFeaturesOf') {{$product->product_type}}</h5>    
                        @foreach ($propertys as $property => $value)
                            @if(\Session::get('locale') == "th")
                                <p style="margin-bottom: 0.3rem; font-size:14px;">- {{$value->film_information_th}}</p>
                            @elseif(\Session::get('locale') == "en")
                                <p style="margin-bottom: 0.3rem; font-size:14px;">- {{$value->film_information_en}}</p>
                            @endif
                        @endforeach
                        <hr>
                        {{-- <h5>@lang('byPhoneModelDetail.prominentPointOf') {{$product->product_type}}</h5>    
                        @foreach ($positives as $positive => $value)
                            <p style="margin-bottom: 0.3rem; font-size:14px;">- {{$value->film_information}}</p>
                        @endforeach
                        <hr> --}}
                        <div class="product-detail">
                            <div class="product-content">
                                <div class="quantity">
                                    <h4>@lang('byPhoneModelDetail.unit') :</h4>
                                    <div class="qty">
                                        <button class="btn-minus" onclick="minus({{$product->id}})"><i class="fa fa-minus"></i></button>
                                        <input type="text" value="1" name="qty" id="qty">
                                        <button class="btn-plus" onclick="plus({{$product->id}})"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>   
                        </div>
                        
                        <p id="number-{{$product->id}}" style="display: none;"></p>
                        <a onclick="add({{$product->id}})" id="product-{{$product->id}}" class="btn-warranty">@lang('byPhoneModelDetail.addToCard')</a>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    var qty = 1;
    document.getElementById(`number-{{$product->id}}`).innerHTML = qty;
    const url = "{{ url('/member/addToCart/') }}"

    function add(productId) {
        console.log(qty);  
        console.log(productId); 
        document.location = `${url}/${productId}/${qty}`
    }

    function plus(productId){
        qty++;
        console.log(qty);
        document.getElementById(`number-${productId}`).innerHTML = qty;
    }


    function minus(productId){
        if (qty > 1) {
            qty--;
            console.log(qty);
            document.getElementById(`number-${productId}`).innerHTML = qty;
        } else {
            qty = 0;
            console.log(qty);
            document.getElementById(`number-${productId}`).innerHTML = qty;
        }
    }
</script>

<div class="featured-product product">
    <div class="container-fluid">
        <center><h2>@lang('byPhoneModelDetail.recommendProducts')<hr width="70px;" style="border-top:5px solid rgba(0,0,0,36%);"></h2></center><br>
        <div class="row align-items-center product-slider product-slider-4" style="margin-top: 2rem;">
            @foreach ($products as $product => $value)
                @php
                    $image = DB::table('image_products')->where('product_id',$value->id)->value('image');
                    $price = DB::table('product_prices')->where('product_id',$value->id)->where('status','เปิด')->orderBy('id','desc')->value('price');
                @endphp
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
                            @else
                                <h5 style="font-weight: bold; padding-left:0.5rem;">@lang('byPhoneModelDetail.amount') {{$price}} @lang('byPhoneModelDetail.thb')</h5>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div> 
@endsection