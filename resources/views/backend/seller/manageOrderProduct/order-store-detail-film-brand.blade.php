@extends("/backend/layouts/template/template-seller")

@section("content")
<div class="main-body">
    <div class="page-wrapper">
        <div class="page-body">
            <div class="card">
                <div class="card-header">
                    <h3>รายละเอียดการสั่งซื้อ หมายเลขบิล {{$order->bill_number}}</h3>
                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                            <li><i class="fa fa fa-wrench open-card-option"></i></li>
                            <li><i class="fa fa-window-maximize full-card"></i></li>
                            <li><i class="fa fa-minus minimize-card"></i></li>
                            <li><i class="fa fa-refresh reload-card"></i></li>
                            <li><i class="fa fa-trash close-card"></i></li>
                        </ul>
                    </div><br>
                    <div class="row">
                        <div class="col-md-4">
                            <h4>ข้อมูลของร้านค้า</h4><hr style="border-top:3px solid rgb(214 214 214)">
                            @php
                                $store_id = DB::table('stores')->where('id',$order->store_id)->value('store_id');
                                $name = DB::table('stores')->where('id',$order->store_id)->value('name');
                                $phone = DB::table('stores')->where('id',$order->store_id)->value('phone');
                            @endphp
                            <p style="font-size: 18px;">หมายเลขสมาชิก : {{$store_id}}</p>
                            <p style="font-size: 18px;">ชื่อลูกค้า : {{$name}}</p>
                            <p style="font-size: 18px;">เบอร์โทรศัพท์ : {{$phone}}</p>
                        </div>
                        <div class="col-md-4">
                            <h4>ข้อมูลการชำระเงิน</h4><hr style="border-top:3px solid rgb(214 214 214)">
                            @php
                                $payday = DB::table('payment_checkout_store_film_brands')->where('store_id',$order->store_id)->where('bill_number',$order->bill_number)->value('payday');
                                $time = DB::table('payment_checkout_store_film_brands')->where('store_id',$order->store_id)->where('bill_number',$order->bill_number)->value('time');
                                $money = DB::table('payment_checkout_store_film_brands')->where('store_id',$order->store_id)->where('bill_number',$order->bill_number)->value('money');
                                $slip = DB::table('payment_checkout_store_film_brands')->where('store_id',$order->store_id)->where('bill_number',$order->bill_number)->value('slip');
                            @endphp
                            <p style="font-size: 18px;">วันที่ชำระเงิน : {{$payday}} {{$time}}</p>
                            <p style="font-size: 18px;">จำนวนเงินที่ชำระ : {{$money}}</p>
                            <a href="{{url('/image_upload/payment_store')}}/{{$slip}}" target="_blank"><p style="font-size: 18px;">หลักฐานการโอนเงิน</p></a>
                        </div>
                        <div class="col-md-4">
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
                <div class="card-block table-border-style">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            @php
                                $NUM_PAGE = 10;
                                $product_ids = DB::table('product_cart_store_film_brands')->where('bill_number',$order->bill_number)->paginate($NUM_PAGE);
                                $page = \Request::input('page');
                                $page = ($page != null)?$page:1;
                            @endphp
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ชื่อสินค้า</th>
                                    <th>ราคาขายต่อหน่วย</th>
                                    <th>จำนวน</th>
                                    <th>ราคารวม</th>
                                    <th>สถานะ</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product_ids as $product_id => $value)
                                    <tr>
                                        <th scope="row">{{$NUM_PAGE*($page-1) + $product_id+1}}</th>
                                        @php
                                            $film_brand = DB::table('product_store_film_brands')->where('id',$value->product_id)->value('film_brand');
                                            $film_type_id = DB::table('product_store_film_brands')->where('id',$value->product_id)->value('film_type_id');
                                            $film_type = DB::table('film_types')->where('id',$film_type_id)->value('film_type');
                                            $price = DB::table('product_store_film_brand_prices')->where('product_id',$value->product_id)->orderBy('id','asc')->value('price');
                                            $sumPrice = $value->qty * $price;
                                            $sumPriceFormat = number_format($sumPrice);
                                        @endphp
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
                                        <td>
                                            <a type="button" data-toggle="modal" data-target="#ModalStatus{{$value->id}}">
                                                <i class="fa fa-pencil-square-o" style="color:blue; font-family: 'Mitr','FontAwesome';"> สถานะการจัดส่ง</i>
                                            </a>
                                        </td>
                                    </tr>
                                    <!-- Modal -->
                                    <div class="modal fade" id="ModalStatus{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">อัพเดตสถานะการจัดส่ง</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{url('/seller/update-order-store-status/film-brand')}}" enctype="multipart/form-data" method="post">@csrf
                                                    <div class="modal-body">
                                                        <div class="form-group row">
                                                            <div class="col-md-2"></div>
                                                            <div class="col-md-8">
                                                                <select name="status" class="form-control">
                                                                    <option value="รอยืนยัน">รอยืนยัน</option>
                                                                    <option value="กำลังจัดส่ง">กำลังจัดส่ง</option>
                                                                    <option value="จัดส่งแล้ว">จัดส่งแล้ว</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-2"></div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <input type="hidden" name="order_id" value="{{$order_id}}">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                                                        <button type="submit" class="btn btn-primary">อัพเดตสถานะการจัดส่ง</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                            {{$product_ids->links()}}
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection