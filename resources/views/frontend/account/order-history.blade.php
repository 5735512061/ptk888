@extends("/frontend/layouts/template/template")
<style>
    .table td {
        padding: 0px !important;
    }
</style>
@section("content")
<div class="container-fluid">
    <center><h2>ประวัติการสั่งซื้อสินค้า<hr width="70px;" style="border-top:5px solid rgb(255 194 49 / 47%)"></h2></center>
</div><br>
@if(count($orders) != 0)
<!-- Cart Start -->
<div class="cart-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-lg-8">
                <div class="cart-page-inner">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>วันที่ทำรายการ</th>
                                    <th>สินค้า</th>
                                    <th>ราคาต่อหน่วย</th>
                                    <th>จำนวน</th>
                                    <th>ราคารวม</th>
                                </tr>
                            </thead>
                            <tbody class="align-middle">
                                @foreach($orders as $order => $value)
                                <tr>
                                    @php 
                                        $product_id = DB::table('product_cart_customers')->where('id',$value->product_cart_id)->value('product_id'); 
                                        $product_name = DB::table('products')->where('id',$product_id)->value('product_name');
                                        $product_image = DB::table('image_products')->where('product_id',$product_id)->value('image'); 
                                        $product_price = DB::table('product_prices')->where('product_id',$product_id)->value('price'); 
                                        $qty = DB::table('product_cart_customers')->where('id',$value->product_cart_id)->value('qty');
                                        $price = DB::table('product_cart_customers')->where('id',$value->product_cart_id)->value('price');
						            @endphp
                                    <td>{{$value->date}}</td>
                                    <td style="width: 30rem;">
                                        <div class="img">
                                            <a href="#"><img src="{{url('/image_upload/image_product')}}/{{$product_image}}"></a>
                                            <p>{{ $product_name }}</p>
                                        </div>
                                    </td>
                                    <td>{{$product_price}}.-</td>
                                    <td>{{$qty}}</td>
                                    @php
                                        $totalPrice = number_format($qty * $price);
                                    @endphp
                                    <td>{{$totalPrice}}.-</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
</div>
<!-- Cart End -->
@else 
    <div class="cart-page">
        <div class="container-fluid">
            <!-- Cart item -->
            <h5 class="m-text20 p-b-24" style="text-align: center;">
                ไม่มีประวัติการสั่งซื้อสินค้า! 
            </h5><br>
            <center>
                <a href="{{url('/')}}" class="btn-warranty" style="text-decoration: none;" >
                    เลือกซื้อสินค้า
                </a>
            </center>
        </div>
    </div>

    <!-- Featured Product Start -->
    <div class="featured-product product">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2 col-12 section-header" style="text-align: center;">
                    <h2>สินค้าแนะนำ<hr class="col-md-1 col-1" style="border-top:5px solid rgba(0,0,0,36%);"></h2>
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
                                $price = DB::table('product_prices')->where('product_id',$value->id)->orderBy('id','desc')->value('price');
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
                                    <h5 style="font-weight: bold; padding-left:0.5rem;">ราคา 0 บาท</h5>
                                @else
                                    <h5 style="font-weight: bold; padding-left:0.5rem;">ราคา {{$price}} บาท</h5>
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