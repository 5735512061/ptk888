@extends("/backend/layouts/template/template-admin")

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
                            <h4>ข้อมูลของลูกค้า</h4><hr style="border-top:3px solid rgb(214 214 214)">
                            @php
                                $member_id = DB::table('members')->where('id',$order->customer_id)->value('member_id');
                                $name = DB::table('members')->where('id',$order->customer_id)->value('name');
                                $surname = DB::table('members')->where('id',$order->customer_id)->value('surname');
                                $phone = DB::table('members')->where('id',$order->customer_id)->value('phone');
                            @endphp
                            <p style="font-size: 18px;">หมายเลขสมาชิก : {{$member_id}}</p>
                            <p style="font-size: 18px;">ชื่อลูกค้า : {{$name}} {{$surname}}</p>
                            <p style="font-size: 18px;">เบอร์โทรศัพท์ : {{$phone}}</p>
                        </div>
                        <div class="col-md-4">
                            <h4>ข้อมูลการชำระเงิน</h4><hr style="border-top:3px solid rgb(214 214 214)">
                            @php
                                $payday = DB::table('payment_checkout_customers')->where('customer_id',$order->customer_id)->value('payday');
                                $time = DB::table('payment_checkout_customers')->where('customer_id',$order->customer_id)->value('time');
                                $money = DB::table('payment_checkout_customers')->where('customer_id',$order->customer_id)->value('money');
                                $slip = DB::table('payment_checkout_customers')->where('customer_id',$order->customer_id)->value('slip');
                            @endphp
                            <p style="font-size: 18px;">วันที่ชำระเงิน : {{$payday}} {{$time}}</p>
                            <p style="font-size: 18px;">จำนวนเงินที่ชำระ : {{$money}}</p>
                            <a href=""><p style="font-size: 18px;">ดาวน์โหลดหลักฐานการโอนเงิน</p></a>
                        </div>
                        <div class="col-md-4">
                            <h4>ที่อยู่สำหรับจัดส่ง</h4><hr style="border-top:3px solid rgb(214 214 214)">
                            @php
                                $name = DB::table('shipment_customers')->where('customer_id',$order->customer_id)->value('name');
                                $phone = DB::table('shipment_customers')->where('customer_id',$order->customer_id)->value('phone');
                                $phone_sec = DB::table('shipment_customers')->where('customer_id',$order->customer_id)->value('phone_sec');
                                $address = DB::table('shipment_customers')->where('customer_id',$order->customer_id)->value('address');
                                $district = DB::table('shipment_customers')->where('customer_id',$order->customer_id)->value('district');
                                $amphoe = DB::table('shipment_customers')->where('customer_id',$order->customer_id)->value('amphoe');
                                $province = DB::table('shipment_customers')->where('customer_id',$order->customer_id)->value('province');
                                $zipcode = DB::table('shipment_customers')->where('customer_id',$order->customer_id)->value('zipcode');
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
                                $product_ids = DB::table('product_cart_customers')->where('bill_number',$order->bill_number)->paginate($NUM_PAGE);
                                $page = \Request::input('page');
                                $page = ($page != null)?$page:1;
                            @endphp
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>รหัสสินค้า</th>
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
                                            $product_code = DB::table('products')->where('id',$value->product_id)->value('product_code');
                                            $product_name = DB::table('products')->where('id',$value->product_id)->value('product_name');
                                            $qty = DB::table('product_cart_customers')->where('id',$value->id)->value('qty');
                                            $price = DB::table('product_cart_customers')->where('id',$value->id)->value('price');
                                            $totalPrice = number_format($qty * $price);
                                        @endphp
                                        <td>{{$product_code}}</td>
                                        <td>{{$product_name}}</td>
                                        <td>{{$price}}.-</td>
                                        <td>{{$qty}}</td>
                                        <td>{{$totalPrice}}.-</td>
                                        <td></td>
                                        <td>       
                                            <a href="{{url('/admin/edit-product')}}/{{$value->id}}">
                                                <i class="fa fa-pencil-square-o" style="color:blue; font-family: 'Mitr','FontAwesome';"> สถานะการจัดส่ง</i>
                                            </a>
                                        </td>
                                    </tr>
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