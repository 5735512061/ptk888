@extends("/backend/layouts/template/template-store")

@section("content")
@if($count_cart == 0)
<center>
    <br>
    <h4>ไม่มีรายการสั่งซื้อ!</h4><br>
    <a href="{{url('/store/order-product')}}" class="btn btn-primary">
        สั่งซื้อสินค้า
    </a>
</center>
@else 
<form action="{{url('/store/payment-checkout-store')}}" enctype="multipart/form-data" method="post">@csrf
<div class="row">
    <div class="col-md-8">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="card">
                        <div class="card-header">
                            <h5>รายการสั่งซื้อสินค้า</h5>
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
                                        <tr>
                                            <th>สินค้า</th>
                                            <th>จำนวน</th>
                                            <th>ราคาต่อแผ่น</th>
                                            <th>ราคารวม (ไม่รวมส่วนลด)</th>
                                        </tr>
                                    </thead>
                                    @php
                                        $totalPrice = 0;
                                    @endphp
                                    <tbody>
                                        @foreach ($product_cart_sessions as $product_cart_session => $value)
                                            <tr>
                                                @php
                                                    $price = DB::table('film_price_stores')->where('id',$value->product_id)->value('price');
                                                    $film_id = DB::table('film_price_stores')->where('id',$value->product_id)->value('film_id');
                                                    $film = DB::table('stock_films')->where('id',$film_id)->value('film_type');
                                                    $sumPrice = $value->qty * $price;
                                                    $sumPriceFormat = number_format($sumPrice);
                                                    $totalPrice += $sumPrice;
                                                @endphp
                                                <td>{{$film}}</td>
                                                <td>{{$value->qty}} แผ่น</td>
                                                <td>{{$price}} บาท</td>
                                                <td>{{$sumPriceFormat}} บาท</td>
                                            </tr>
                                        @endforeach
                                    </tbody> 
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-body">
                    <div class="card">
                        <div class="card-header">
                            <h5>ที่อยู่ในการจัดส่งสินค้า</h5>
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
                        <div class="card-block">
                                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                    @if(Session::has('alert-' . $msg))
                                        <p class="alertdesign alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                                    @endif
                                @endforeach
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">ชื่อ-นามสกุล</label>
                                    <div class="col-sm-10">
                                        @if ($errors->has('name'))
                                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('name') }})</span>
                                        @endif
                                        <input type="text" class="form-control" placeholder="กรุณากรอกชื่อและนามสกุล" name="name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">เบอร์โทรศัพท์</label>
                                    <div class="col-sm-10">
                                        @if ($errors->has('phone'))
                                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('phone') }})</span>
                                        @endif
                                        <input type="text" class="phone_format form-control" placeholder="กรุณากรอกเบอร์โทรศัพท์" name="phone">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">เบอร์โทรศัพท์ (ถ้ามี)</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="phone_format form-control" placeholder="กรุณากรอกเบอร์โทรศัพท์สำรอง (ถ้ามี)" name="phone_sec">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">ที่อยู่</label>
                                    <div class="col-sm-10">
                                        @if ($errors->has('address'))
                                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('address') }})</span>
                                        @endif
                                        <input type="text" class="form-control" placeholder="กรุณากรอกที่อยู่ หมู่บ้าน ถนน หรือตรอก/ซอย (ถ้ามี)" name="address">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">ตำบล</label>
                                    <div class="col-sm-10">
                                        @if ($errors->has('district'))
                                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('district') }})</span>
                                        @endif
                                        <input type="text" class="form-control" placeholder="กรุณากรอกตำบล" name="district">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">อำเภอ</label>
                                    <div class="col-sm-10">
                                        @if ($errors->has('amphoe'))
                                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('amphoe') }})</span>
                                        @endif
                                        <input type="text" class="form-control" placeholder="กรุณากรอกอำเภอ" name="amphoe">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">จังหวัด</label>
                                    <div class="col-sm-10">
                                        @if ($errors->has('province'))
                                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('province') }})</span>
                                        @endif
                                        <input type="text" class="form-control" placeholder="กรุณากรอกจังหวัด" name="province">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">รหัสไปรษณีย์</label>
                                    <div class="col-sm-10">
                                        @if ($errors->has('zipcode'))
                                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('zipcode') }})</span>
                                        @endif
                                        <input type="text" class="form-control" placeholder="กรุณากรอกรหัสไปรษณีย์" name="zipcode">
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="card">
                        <div class="card-header">
                            <h5>สรุปยอดการสั่งซื้อสินค้า</h5>
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
                            <div class="cart-page-inner">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="cart-summary" style="text-align: right;">
                                            <div class="cart-content">
                                                @foreach($product_cart_sessions as $product_cart_session => $value)
                                                    @php 
                                                        $price = DB::table('film_price_stores')->where('id',$value->product_id)->value('price'); 
                                                    @endphp
                                                    <input type="hidden" value="{{ $value->product_id }}" name="product_id[]">
                                                    <input type="hidden" value="{{ $price }}" name="price[]">
                                                    <input type="hidden" value="{{ $value->qty }}" name="qty[]">
                                                @endforeach
                                                @php
                                                    $totalPriceFormat = number_format($totalPrice);
                                                    $qtyCartStoreTotal = DB::table('product_cart_stores')->where('store_id',Auth::guard('store')->user()->id)
                                                                                                         ->where('product_id','!=','11')
                                                                                                         ->sum('qty');

                                                @endphp
                                                <h4>ยอดสินค้า<span> {{$totalPriceFormat}} บาท</span></h4><br>

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

                                                <h4>ส่วนลดสินค้า<span> {{$totalDiscountFormat}} บาท</span></h4><br>
                                                <h4>ค่าจัดส่ง<span> 0 บาท</span></h4><br>
                                                @php
                                                    $totalPrice = number_format($totalPrice - $totalDiscount);
                                                @endphp
                                                <h3>รวมทั้งสิ้น<span> {{$totalPrice}} บาท</span></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="page-body">
                    <div class="card">
                        <div class="card-header">
                            <h5>รายละเอียดการชำระเงิน</h5>
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
                            <div class="cart-page-inner">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="cart-summary" style="text-align: center;">
                                            <div class="cart-content">
                                                <h3>รายละเอียดการชำระเงิน</h3><br>
                                                <h4>ธนาคารกสิกรไทย</h4><br>
                                                <h4>เลขที่บัญชี : 072-2-27925-5</h4><br>
                                                <h4>ชื่อบัญชี : บจก. พี ที เค 888</h4><br>
                                                @if ($errors->has('money'))
                                                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('money') }})</span>
                                                @endif
                                                <input class="form-control" type="text" placeholder="* จำนวนเงิน ตัวอย่าง 790 บาท" style="font-size: 14px;" name="money"><br>
                                                @if ($errors->has('payday'))
                                                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('payday') }})</span>
                                                @endif
                                                <input class="form-control" type="text" placeholder="* วันที่ชำระเงิน ตัวอย่าง 01/01/2564" style="font-size: 14px;" name="payday"><br>
                                                @if ($errors->has('time'))
                                                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('time') }})</span>
                                                @endif
                                                <input class="form-control" type="text" placeholder="* เวลาชำระเงิน ตัวอย่าง 14.30น." style="font-size: 14px;" name="time"><br>
                                                <label class="col-form-label">แนบหลักฐานการโอนเงิน</label>
                                                @if ($errors->has('slip'))
                                                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('slip') }})</span>
                                                @endif
                                                <input type="file" class="form-control" name="slip">
                                            </div><br>
                                            <div class="cart-btn">
                                                <a style="text-decoration: none;" href="{{url('/store/payment-checkout-store')}}">
                                                    <button class="btn btn-primary">แจ้งชำระเงิน</button>
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
        </div>
    </div>
</div>
</form>
@endif
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