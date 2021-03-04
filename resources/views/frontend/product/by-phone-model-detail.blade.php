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
                <div class="col-lg-7">
                    <div class="description">
                        <h4 style="font-weight: bold;">{{$product->product_name}}</h4>
                        <h4 style="font-weight: bold; color:#FF8930;">ราคา 790 บาท</h4><hr>
                        <p>คุณสมบัติฟิล์มไฮโดรเจล</p>    
                        <p>-</p>
                        <p>-</p>
                        <p>-</p>
                        <p>-</p>
                        <hr>
                        <div class="product-detail">
                            <div class="product-content">
                                <div class="quantity">
                                    <h4>จำนวน :</h4>
                                    <div class="qty">
                                        <button class="btn-minus"><i class="fa fa-minus"></i></button>
                                        <input type="text" value="1">
                                        <button class="btn-plus"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>   
                        </div>
                        
                        <a class="btn-warranty" href="{{url('/member/register-warranty')}}">หยิบสินค้าใส่ตะกร้า</a>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="featured-product product">
    <div class="container-fluid">
        <center><h2>สินค้าแนะนำอื่นๆ<hr width="70px;" style="border-top:5px solid rgba(0,0,0,36%);"></h2></center><br>
        <div class="row align-items-center product-slider product-slider-4" style="margin-top: 2rem;">
            @foreach ($products as $product => $value)
                @php
                    $image = DB::table('image_products')->where('product_id',$value->id)->value('image');
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
                            <h5 style="font-weight: bold; padding-left:0.5rem;">ราคา 790 บาท</h5>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>  
@endsection