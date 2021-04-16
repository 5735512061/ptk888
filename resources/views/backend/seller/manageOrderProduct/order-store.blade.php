@extends("/backend/layouts/template/template-seller")

@section("content")
<div class="main-body">
    <div class="page-wrapper">
        <div class="page-body">
            <div class="card table-card">
                <div class="card-header">
                    <h5>ค้นหาคำสั่งซื้อของร้านค้า</h5>
                </div><br>
                <div class="card-block">
                    <form action="{{url('/seller/search-order-store')}}" enctype="multipart/form-data" method="post">@csrf
                        <div class="row" style="margin-left: 5px; margin-right: 5px;">
                            <div class="col-md-3">
                                <input type="text" name="store_id" class="form-control" placeholder="ค้นหาหมายเลขสมาชิก"><br>
                                <button type="submit" class="btn btn-mat waves-effect waves-light btn-primary">ค้นหาหมายเลขสมาชิก</button>
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="bill_number" class="form-control" placeholder="ค้นหาเลขที่บิล"><br>
                                <button type="submit" class="btn btn-mat waves-effect waves-light btn-primary">ค้นหาเลขที่บิล</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h5>ข้อมูลการสั่งซื้อของร้านค้า</h5>
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
                                    <th>หมายเลขสมาชิกร้านค้า</th>
                                    <th>บิลเลขที่</th>
                                    <th>วันที่สั่งซื้อ</th>
                                    <th>จำนวน</th>
                                    <td>ราคารวม</td>
                                    <td>ส่วนลดรวม</td>
                                    <td>ราคาทั้งหมด</td>
                                    <th>สถานะ</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $sumDiscount = 0;
                                @endphp
                                @foreach ($orders as $order => $value)
                                    <tr>
                                        <th scope="row">{{$NUM_PAGE*($page-1) + $order+1}}</th>
                                        @php
                                            $qty = DB::table('product_cart_stores')->where('bill_number',$value->bill_number)->sum('qty');
                                            $sumPrice = DB::table('product_cart_stores')->where('bill_number',$value->bill_number)
                                                                                          ->sum(DB::raw('price * qty'));
                                            $totalPriceFormat = number_format($sumPrice);

                                            $qtyCartStoreTotal = DB::table('product_cart_stores')->where('store_id',$value->store_id)
                                                                                                 ->where('product_id','!=','11')
                                                                                                 ->sum('qty');

                                            $store_id = DB::table('stores')->where('id',$value->store_id)->value('store_id');
                                            $id = DB::table('stores')->where('id',$value->store_id)->value('id');
                                            $product_ids = DB::table('product_cart_stores')->where('bill_number',$value->bill_number)->get();
                                        @endphp
                                        <td>{{$store_id}}</td>
                                        <td><a href="{{url('/seller/order-store-detail/')}}/{{$value->id}}" style="color: blue;">{{$value->bill_number}}</a></td>
                                        <td>{{$value->date}}</td>
                                        <td>{{$qty}}</td>
                                        <td>{{$totalPriceFormat}} บาท</td>
                                        @foreach ($product_ids as $product_id => $value)
                                            @php
                                                $qty = DB::table('product_cart_stores')->where('store_id',$id)
                                                                                       ->where('product_id',$value->product_id)
                                                                                       ->sum('qty');
                                                if($qty < 3001 && $qty > 1500)  
                                                    $discount = 5/100;
                                                elseif($qty < 4501 && $qty > 3000)
                                                    $discount = 7/100;
                                                elseif($qty > 4500)
                                                    $discount = 10/100;
                                                else
                                                    $discount = 0;
                                            @endphp
                                        @endforeach

                                        @php
                                            $totalDiscount =  $sumPrice * $discount;
                                            $sumDiscountRound = round($totalDiscount,0);
                                            $totalDiscountFormat = number_format($totalDiscount);
                                            $sumDiscountFormat = number_format($sumDiscountRound);
                                        @endphp

                                        <td>{{$totalDiscountFormat}} บาท</td>
                                        @php
                                            $totalPrice = number_format($sumPrice - $sumDiscountRound);
                                        @endphp
                                        <td>{{$totalPrice}} บาท</td>
                                        <td>
                                            @php
                                                $status = DB::table('order_store_confirms')->where('order_id',$value->id)->value('status');
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
                                            <a href="{{url('/seller/order-store-detail/')}}/{{$value->id}}" style="color: blue;">
                                                ตรวจสอบการสั่งซื้อ
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            {{$orders->links()}}
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection