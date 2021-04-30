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
                                $payday = DB::table('payment_checkout_customers')->where('customer_id',$order->customer_id)->where('bill_number',$order->bill_number)->value('payday');
                                $time = DB::table('payment_checkout_customers')->where('customer_id',$order->customer_id)->where('bill_number',$order->bill_number)->value('time');
                                $money = DB::table('payment_checkout_customers')->where('customer_id',$order->customer_id)->where('bill_number',$order->bill_number)->value('money');
                                $slip = DB::table('payment_checkout_customers')->where('customer_id',$order->customer_id)->where('bill_number',$order->bill_number)->value('slip');
                            @endphp
                            <p style="font-size: 18px;">วันที่ชำระเงิน : {{$payday}} {{$time}}</p>
                            <p style="font-size: 18px;">จำนวนเงินที่ชำระ : {{$money}}</p>
                            <a href="{{url('/image_upload/payment_customer')}}/{{$slip}}" target="_blank"><p style="font-size: 18px;">หลักฐานการโอนเงิน</p></a>
                        </div>
                        <div class="col-md-4">
                            <h4>ที่อยู่สำหรับจัดส่ง</h4><hr style="border-top:3px solid rgb(214 214 214)">
                            @php
                                $name = DB::table('shipment_customers')->where('customer_id',$order->customer_id)->where('bill_number',$order->bill_number)->value('name');
                                $phone = DB::table('shipment_customers')->where('customer_id',$order->customer_id)->where('bill_number',$order->bill_number)->value('phone');
                                $phone_sec = DB::table('shipment_customers')->where('customer_id',$order->customer_id)->where('bill_number',$order->bill_number)->value('phone_sec');
                                $address = DB::table('shipment_customers')->where('customer_id',$order->customer_id)->where('bill_number',$order->bill_number)->value('address');
                                $district = DB::table('shipment_customers')->where('customer_id',$order->customer_id)->where('bill_number',$order->bill_number)->value('district');
                                $amphoe = DB::table('shipment_customers')->where('customer_id',$order->customer_id)->where('bill_number',$order->bill_number)->value('amphoe');
                                $province = DB::table('shipment_customers')->where('customer_id',$order->customer_id)->where('bill_number',$order->bill_number)->value('province');
                                $zipcode = DB::table('shipment_customers')->where('customer_id',$order->customer_id)->where('bill_number',$order->bill_number)->value('zipcode');
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
                                        <td>
                                            @php
                                                $order_id = DB::table('order_customers')->where('product_cart_id',$value->id)->value('id');
                                                $status = DB::table('order_customer_confirms')->where('order_id',$order_id)->orderBy('id','desc')->value('status');
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
                                        <td>
                                            @if($status == null || $status == 'รอยืนยัน')
                                                <a type="button" data-toggle="modal" data-target="#ModalAddress{{$value->id}}">
                                                    <i class="fa fa-pencil-square-o" style="color:blue; font-family: 'Mitr','FontAwesome';"> แก้ไขที่อยู่จัดส่ง</i>
                                                </a>
                                            @elseif($status == 'กำลังจัดส่ง')
                                                <p style="color:red; font-size:15px;">ไม่สามารถแก้ไขที่อยู่จัดส่งได้</p>
                                            @else
                                                <p style="color:red; font-size:15px;">ไม่สามารถแก้ไขที่อยู่จัดส่งได้</p>
                                            @endif
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
                                                <form action="{{url('/admin/update-order-customer-status')}}" enctype="multipart/form-data" method="post">@csrf
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
                                    <!-- Modal Address-->
                                    <div class="modal fade" id="ModalAddress{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">แก้ไขที่อยู่จัดส่ง</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{url('/admin/update-address-customer')}}" enctype="multipart/form-data" method="post">@csrf
                                                    <div class="modal-body">
                                                        <div class="form-group row">
                                                            <label class="col-sm-4 col-form-label">ชื่อลูกค้า</label>
                                                            <div class="col-md-8">
                                                                <input type="text" name="name" class="form-control" value="{{$name}}"><br>
                                                            </div>
                                                            <label class="col-sm-4 col-form-label">หมายเลขโทรศัพท์</label>
                                                            <div class="col-md-8">
                                                                <input type="text" name="phone" class="phone_format form-control" value="{{$phone}}"><br>
                                                            </div>
                                                            <label class="col-sm-4 col-form-label">ที่อยู่</label>
                                                            <div class="col-md-8">
                                                                <input type="text" name="address" class="form-control" value="{{$address}}"><br>
                                                            </div>
                                                            <label class="col-sm-4 col-form-label">ตำบล</label>
                                                            <div class="col-md-8">
                                                                <input type="text" name="district" class="form-control" value="{{$district}}"><br>
                                                            </div>    
                                                            <label class="col-sm-4 col-form-label">อำเภอ</label>
                                                            <div class="col-md-8">
                                                                <input type="text" name="amphoe" class="form-control" value="{{$amphoe}}"><br>
                                                            </div>   
                                                            <label class="col-sm-4 col-form-label">จังหวัด</label>
                                                            <div class="col-md-8">
                                                                <input type="text" name="province" class="form-control" value="{{$province}}"><br>
                                                            </div> 
                                                            <label class="col-sm-4 col-form-label">รหัสไปรษณีย์</label>
                                                            <div class="col-md-8">
                                                                <input type="text" name="zipcode" class="form-control" value="{{$zipcode}}"><br>
                                                            </div>    
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <input type="hidden" name="id" value="{{$order_id}}">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                                                        <button type="submit" class="btn btn-primary">อัพเดตที่อยู่การจัดส่ง</button>
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
<script type="text/javascript" src="{{asset('https://code.jquery.com/jquery-3.2.1.min.js')}}"></script>
<script>
   // number phone
   function phoneFormatter() {
        $('input.phone_format').on('input', function() {
            var number = $(this).val().replace(/[^\d]/g, '')
                if (number.length >= 5 && number.length < 10) { number = number.replace(/(\d{3})(\d{2})/, "$1-$2"); } else if (number.length >= 10) {
                    number = number.replace(/(\d{3})(\d{3})(\d{3})/, "$1-$2-$3"); 
                }
            $(this).val(number)
            $('input.phone_format').attr({ maxLength : 12 });    
        });
    };
    $(phoneFormatter);
</script>
@endsection