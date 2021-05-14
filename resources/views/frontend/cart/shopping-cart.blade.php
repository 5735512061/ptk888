@extends("/frontend/layouts/template/template")

@section("content")

@if(Session::has('cart'))
<!-- Cart Start -->
<div class="cart-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="cart-page-inner">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>@lang('shoppingCart.product')</th>
                                    <th>@lang('shoppingCart.pricePerUnit')</th>
                                    <th>@lang('shoppingCart.unit')</th>
                                    <th>@lang('shoppingCart.subTotalPrice')</th>
                                    <th>@lang('shoppingCart.delete')</th>
                                </tr>
                            </thead>
                            @php
                                $price = 0;
                            @endphp
                            <tbody class="align-middle">
                                @foreach($products as $product)
                                <tr>
                                    @php 
                                        $id = $product['item'];
                                        $product_name = DB::table('products')->where('id',$id)->value('product_name'); 
                                        $product_image = DB::table('image_products')->where('product_id',$id)->value('image'); 
                                        $product_price = DB::table('product_prices')->where('product_id',$id)->orderBy('id','desc')->value('price'); 
                                        $promotion_price = DB::table('product_promotion_prices')->where('product_id',$id)->orderBy('id','desc')->value('promotion_price');
                                        $price += $product['price'];
						            @endphp
                                    <td style="width: 30rem;">
                                        <div class="img">
                                            <a href="#"><img src="{{url('/image_upload/image_product')}}/{{$product_image}}"></a>
                                            <p>{{ $product_name }}</p>
                                        </div>
                                    </td>
                                        @if($promotion_price == null)
                                            <td>{{$product_price}}.-</td>
                                        @else
                                            <td>{{$promotion_price}}.-</td>
                                        @endif
                                    <td>
                                        {{$product['qty']}}
                                    </td>
                                    <td>{{ number_format($product['price']) }}.-</td>
                                    <td><a href="{{ route('remove', ['id' => $product['item']]) }}" class="btn btn-primary btn-xs"><i class="fa fa-trash"></i></a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="cart-page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="coupon">
                                <input type="text" placeholder="@lang('placeholder.discountCode')">
                                <button>@lang('shoppingCart.discountCode')</button>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="cart-summary">
                                <div class="cart-content">
                                    <h1>@lang('shoppingCart.orderSummary')</h1>
                                    <p>@lang('shoppingCart.total')<span>{{ number_format($price) }} @lang('shoppingCart.thb')</span></p>
                                    <p>@lang('shoppingCart.shippingFee')<span>0 @lang('shoppingCart.thb')</span></p>
                                    <h2>@lang('shoppingCart.subTotal')<span>{{ number_format($price) }} @lang('shoppingCart.thb')</span></h2>
                                </div>
                                <div class="cart-btn">
                                    <a style="text-decoration: none;" href="{{ route('checkout') }}">
                                        <button>@lang('shoppingCart.proceedToCheckout')</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart End -->
@else 
    <div class="cart-page">
        <div class="container-fluid">
            <!-- Cart item -->
            <h5 class="m-text20 p-b-24" style="text-align: center;">
                @lang('shoppingCart.noProductsInCart')! 
            </h5><br>
            <center>
                <a href="{{url('/')}}" class="btn-warranty" style="text-decoration: none;" >
                    @lang('shoppingCart.continueOrdering')
                </a>
            </center>
        </div>
    </div>

    <!-- Featured Product Start -->
    <div class="featured-product product">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2 col-12 section-header" style="text-align: center;">
                    <h2>@lang('shoppingCart.recommendedProducts')<hr class="col-md-1 col-1" style="border-top:5px solid rgba(0,0,0,36%);"></h2>
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
                                    <h5 style="font-weight: bold; padding-left:0.5rem;">@lang('shoppingCart.amount') 0 @lang('shoppingCart.thb')</h5>
                                @else
                                    <h5 style="font-weight: bold; padding-left:0.5rem;">@lang('shoppingCart.amount') {{$price}} @lang('shoppingCart.thb')</h5>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Featured Product End -->   
@endif
@endsection