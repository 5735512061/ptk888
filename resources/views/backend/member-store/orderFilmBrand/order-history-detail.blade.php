@extends("/backend/layouts/template/template-store")

@section("content")
<div class="container-fluid">
    <div class="col-md-2"></div>
    <div class="col-lg-8">
        <br><h3>รายละเอียดการสั่งซื้อ หมายเลขบิล {{$order->bill_number}}</h3><br>
        <div class="row">
            <div class="col-md-6">
                <h4>ข้อมูลการชำระเงิน</h4><hr style="border-top:3px solid rgb(214 214 214)">
                @php
                    $payday = DB::table('payment_checkout_store_film_brands')->where('store_id',$order->store_id)->where('bill_number',$order->bill_number)->value('payday');
                    $time = DB::table('payment_checkout_store_film_brands')->where('store_id',$order->store_id)->where('bill_number',$order->bill_number)->value('time');
                    $money = DB::table('payment_checkout_store_film_brands')->where('store_id',$order->store_id)->where('bill_number',$order->bill_number)->value('money');
                @endphp
                <p style="font-size: 18px;">วันที่ชำระเงิน : {{$payday}} {{$time}}</p>
                <p style="font-size: 18px;">จำนวนเงินที่ชำระ : {{$money}}</p>
            </div>
            <div class="col-md-6">
                <h4>ที่อยู่สำหรับจัดส่ง</h4><hr style="border-top:3px solid rgb(214 214 214)">
                @php
                    $name = DB::table('shipment_store_film_brands')->where('store_id',$order->store_id)->where('bill_number',$order->bill_number)->value('name');
                    $phone = DB::table('shipment_store_film_brands')->where('store_id',$order->store_id)->where('bill_number',$order->bill_number)->value('phone');
                    $phone_sec = DB::table('shipment_store_film_brands')->where('store_id',$order->store_id)->where('bill_number',$order->bill_number)->value('phone_sec');
                    $address = DB::table('shipment_store_film_brands')->where('store_id',$order->store_id)->where('bill_number',$order->bill_number)->value('address');
                    $district = DB::table('shipment_store_film_brands')->where('store_id',$order->store_id)->where('bill_number',$order->bill_number)->value('district');
                    $amphoe = DB::table('shipment_store_film_brands')->where('store_id',$order->store_id)->where('bill_number',$order->bill_number)->value('amphoe');
                    $province = DB::table('shipment_store_film_brands')->where('store_id',$order->store_id)->where('bill_number',$order->bill_number)->value('province');
                    $zipcode = DB::table('shipment_store_film_brands')->where('store_id',$order->store_id)->where('bill_number',$order->bill_number)->value('zipcode');
                @endphp
                <p style="font-size: 16px;">{{$name}} {{$phone}},{{$phone_sec}}</p>
                <p style="font-size: 16px;">ที่อยู่ {{$address}} ตำบล {{$district}} อำเภอ {{$amphoe}} จังหวัด {{$province}} {{$zipcode}}</p>
            </div>
        </div>
    </div>
    <div class="col-md-2"></div>
</div>

<div class="main-body">
    <div class="page-wrapper">
        <div class="page-body">
            <div class="card">
                <div class="card-header">
                    <h5>รายละเอียดการสั่งซื้อ หมายเลขบิล {{$order->bill_number}}</h5>
                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                            <li><i class="fa fa fa-wrench open-card-option"></i></li>
                            <li><i class="fa fa-window-maximize full-card"></i></li>
                            <li><i class="fa fa-minus minimize-card"></i></li>
                            <li><i class="fa fa-refresh reload-card"></i></li>
                            <li><i class="fa fa-trash close-card"></i></li>
                        </ul>
                    </div>
                </div>
                <div class="card-block table-border-style">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                @php
                                    $NUM_PAGE = 10;
                                    $product_ids = DB::table('product_cart_store_film_brands')->where('bill_number',$order->bill_number)->paginate($NUM_PAGE);
                                    $page = \Request::input('page');
                                    $page = ($page != null)?$page:1;
                                @endphp
                                <tr>
                                    <td>#</td>
                                    <td>ชื่อสินค้า</td>
                                    <td>ราคาขายต่อหน่วย</td>
                                    <td>จำนวน</td>
                                    <td>ราคารวม</td>
                                    <td>สถานะ</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product_ids as $product_id => $value)
                                    <tr>
                                        @php
                                            $film_brand = DB::table('product_store_film_brands')->where('id',$value->product_id)->value('film_brand');
                                            $film_type_id = DB::table('product_store_film_brands')->where('id',$value->product_id)->value('film_type_id');
                                            $film_type = DB::table('film_types')->where('id',$film_type_id)->value('film_type');
                                            $price = DB::table('product_store_film_brand_prices')->where('product_id',$value->product_id)->orderBy('id','desc')->value('price');
                                            $sumPrice = $value->qty * $price;
                                            $sumPriceFormat = number_format($sumPrice);
                                        @endphp
                                        <td scope="row">{{$NUM_PAGE*($page-1) + $product_id+1}}</td>
                                        <td>{{$film_brand}} {{$film_type}}</td>
                                        <td>{{$price}}.-</td>
                                        <td>{{$value->qty}}</td>
                                        <td>{{$sumPriceFormat}}.-</td> 
                                        <td>
                                            @php
                                                $order_id = DB::table('order_store_film_brands')->where('product_cart_id',$value->id)->value('id');
                                                $status = DB::table('order_store_confirm_film_brands')->where('order_id',$order_id)->orderBy('id','desc')->value('status');
                                            @endphp
                                            @if($status == null || $status == 'รอยืนยัน')
                                                <p style="color: red; font-size:15px;">รอยืนยัน</p>
                                            @elseif($status == 'กำลังจัดส่ง')
                                                <p style="color:blue; font-size:15px;">กำลังจัดส่ง</p>
                                            @else
                                                <p style="color:green; font-size:15px;">จัดส่งแล้ว</p>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection