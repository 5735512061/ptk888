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
                    $payday = DB::table('payment_checkout_stores')->where('store_id',$order->store_id)->value('payday');
                    $time = DB::table('payment_checkout_stores')->where('store_id',$order->store_id)->value('time');
                    $money = number_format(DB::table('payment_checkout_stores')->where('store_id',$order->store_id)->value('money'));
                @endphp
                <p style="font-size: 18px;">วันที่ชำระเงิน : {{$payday}} {{$time}}</p>
                <p style="font-size: 18px;">จำนวนเงินที่ชำระ : {{$money}}</p>
            </div>
            <div class="col-md-6">
                <h4>ที่อยู่สำหรับจัดส่ง</h4><hr style="border-top:3px solid rgb(214 214 214)">
                @php
                    $name = DB::table('shipment_stores')->where('store_id',$order->store_id)->value('name');
                    $phone = DB::table('shipment_stores')->where('store_id',$order->store_id)->value('phone');
                    $phone_sec = DB::table('shipment_stores')->where('store_id',$order->store_id)->value('phone_sec');
                    $address = DB::table('shipment_stores')->where('store_id',$order->store_id)->value('address');
                    $district = DB::table('shipment_stores')->where('store_id',$order->store_id)->value('district');
                    $amphoe = DB::table('shipment_stores')->where('store_id',$order->store_id)->value('amphoe');
                    $province = DB::table('shipment_stores')->where('store_id',$order->store_id)->value('province');
                    $zipcode = DB::table('shipment_stores')->where('store_id',$order->store_id)->value('zipcode');
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
                                    $product_ids = DB::table('product_cart_stores')->where('bill_number',$order->bill_number)->paginate($NUM_PAGE);
                                    $page = \Request::input('page');
                                    $page = ($page != null)?$page:1;
                                @endphp
                                <tr>
                                    <td>#</td>
                                    <td>ชื่อสินค้า</td>
                                    <td>ราคาขายต่อหน่วย</td>
                                    <td>จำนวน</td>
                                    <td>ราคารวม</td>
                                    <td>ส่วนลดรวม</td>
                                    <td>ราคาทั้งหมด</td>
                                    <td>สถานะ</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product_ids as $product_id => $value)
                                    <tr>
                                        @php 
                                            $totalPrice = DB::table('product_cart_stores')->where('bill_number',$value->bill_number)
                                                                                          ->sum(DB::raw('price * qty'));
                                            $totalPriceFormat = number_format($totalPrice);

                                            $qtyCartStoreTotal = DB::table('product_cart_stores')->where('store_id',Auth::guard('store')->user()->id)
                                                                                                 ->where('product_id','!=','11')
                                                                                                 ->sum('qty');
						                @endphp
                                        @php
                                            $film_id = DB::table('film_price_stores')->where('id',$value->product_id)->value('film_id');
                                            $product_name = DB::table('stock_films')->where('id',$film_id)->value('film_type');
                                            $qty = DB::table('product_cart_stores')->where('id',$value->id)->value('qty');
                                            $price = DB::table('product_cart_stores')->where('id',$value->id)->value('price');
                                        @endphp
                                        <td scope="row">{{$NUM_PAGE*($page-1) + $product_id+1}}</td>
                                        <td>{{$product_name}}</td>
                                        <td>{{$price}}.-</td>
                                        <td>{{$qty}}</td>
                                        <td>{{$totalPriceFormat}}.-</td>
                                        @php
                                            if($qtyCartStoreTotal < 1001 || $qtyCartStoreTotal > 1)  
                                                $discount = $qty * 70;
                                            elseif($qtyCartStoreTotal < 5001 || $qtyCartStoreTotal > 1001)
                                                $discount = $qty * 68;
                                            elseif($qtyCartStoreTotal > 5001)
                                                $discount = $qty * 65;
                                        @endphp

                                        @php
                                            $totalDiscount =  $totalPrice - $discount;
                                            $totalDiscountFormat = number_format($totalDiscount);
                                        @endphp

                                        <td>{{$totalDiscountFormat}} บาท</td>
                                        @php
                                            $totalPrice = number_format($totalPrice - $totalDiscount);
                                        @endphp
                                        <td>{{$totalPrice}} บาท</td>
                                        <td>
                                            @php
                                                $order_id = DB::table('order_stores')->where('product_cart_id',$value->id)->value('id');
                                                $status = DB::table('order_store_confirms')->where('order_id',$order_id)->orderBy('id','desc')->value('status');
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