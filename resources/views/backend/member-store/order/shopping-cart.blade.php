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
                                            <th>#</th>
                                            <th>สินค้า</th>
                                            <th>จำนวน</th>
                                            <th>ราคาต่อแผ่น</th>
                                            <th>ราคารวม (ไม่รวมส่วนลด)</th>
                                            <th>ส่วนลด</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    @php
                                        $totalPrice = 0;
                                        $sumDiscount = 0;
                                    @endphp
                                    <tbody>
                                        @foreach ($product_cart_sessions as $product_cart_session => $value)
                                            <tr>
                                                <th scope="row">{{$NUM_PAGE*($page-1) + $product_cart_session+1}}</th>
                                                @php
                                                    $price = DB::table('film_price_stores')->where('id',$value->product_id)->value('price');
                                                    $film_id = DB::table('film_price_stores')->where('id',$value->product_id)->value('film_id');
                                                    $film = DB::table('stock_films')->where('id',$film_id)->value('film_type');
                                                    $sumPrice = $value->qty * $price;
                                                    $sumPriceFormat = number_format($sumPrice);
                                                    $totalPrice += $sumPrice;
                                                @endphp

                                                @php
                                                    $film_id = DB::table('stock_films')->where('film_type',$film)->value('id');
                                                    $product_id = DB::table('film_price_stores')->where('film_id',$film_id)->orderBy('id','desc')->value('id');

                                                    $qtyCart = DB::table('product_cart_stores')->where('store_id',Auth::guard('store')->user()->id)
                                                                                               ->where('product_id',$product_id)
                                                                                               ->sum('qty');
                                                    $qtySession = DB::table('product_cart_session_stores')->where('store_id',Auth::guard('store')->user()->id)
                                                                                                          ->where('product_id',$product_id)
                                                                                                          ->sum('qty');
                                                    // เอาค่านี้ไปคำนวณ 
                                                    $qty = $qtyCart + $qtySession;

                                                    
                                                    if($qty < 3001 && $qty > 1500)  
                                                        $discount = 5/100;
                                                    elseif($qty < 4501 && $qty > 3000)
                                                        $discount = 7/100;
                                                    elseif($qty > 4500)
                                                        $discount = 10/100;
                                                    else
                                                        $discount = 0;

                                                @endphp
                                                @php
                                                    $totalDiscount =  $sumPrice * $discount;
                                                    $sumDiscount += $totalDiscount;
                                                    $sumDiscountRound = round($sumDiscount,0);
                                                    $totalDiscountFormat = number_format($totalDiscount);
                                                    $sumDiscountFormat = number_format($sumDiscountRound);
                                                @endphp
                                                <td>{{$film}}</td>
                                                <td>{{$value->qty}} แผ่น</td>
                                                <td>{{$price}} บาท</td>
                                                <td>{{$sumPriceFormat}} บาท</td>
                                                <td>{{$totalDiscountFormat}} บาท</td>
                                                <td>          
                                                    <a href="{{url('/store/remove-shopping-cart/')}}/{{$value->id}}" style="color:red;">
                                                        ยกเลิกรายการสินค้า
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody> 
                                    {{$product_cart_sessions->links()}}
                                </table>
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
                            <h5>ยืนยันรายการสินค้า</h5>
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
                                    <div class="col-md-8">
                                        <input type="text" placeholder="กรอกโค้ดส่วนลด" class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <button class="btn btn-primary" style="padding-bottom:5px;">ใช้โค้ดส่วนลด</button>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="cart-summary" style="text-align: right;">
                                            <div class="cart-content">
                                                <h3>สรุปยอดรายการสินค้าทั้งหมด</h3><br>
                                                @php
                                                    $totalPriceFormat = number_format($totalPrice);
                                                @endphp
                                                <h4>ยอดสินค้า<span> {{$totalPriceFormat}} บาท</span></h4><br>
                                                <h4>ส่วนลดสินค้า<span> {{$sumDiscountFormat}} บาท</span></h4><br>
                                                <h4>ค่าจัดส่ง<span> 0 บาท</span></h4><br>
                                                @php
                                                    $totalPrice = number_format($totalPrice - $sumDiscountRound);
                                                @endphp
                                                <h2>รวมทั้งสิ้น<span> {{$totalPrice}} บาท</span></h2>
                                            </div><br>
                                            <div class="cart-btn">
                                                <a style="text-decoration: none;" href="{{url('/store/checkout/')}}">
                                                    <button class="btn btn-primary">ดำเนินการชำระเงิน</button>
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
@endif
@endsection