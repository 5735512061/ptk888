@extends("/backend/layouts/template/template-store")
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
                                    <th>บิลเลขที่</th>
                                    <th>วันที่ทำรายการ</th>
                                    <th>จำนวน</th>
                                    <th>ราคารวม</th>
                                    <th>สถานะ</th>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody class="align-middle">
                                @foreach($orders as $order => $value)
                                <tr>
                                    @php 
                                        $qty = DB::table('product_cart_customers')->where('bill_number',$value->bill_number)->sum('qty');
                                        $totalPrice = DB::table('product_cart_customers')->where('bill_number',$value->bill_number)
                                                                                         ->sum(DB::raw('price * qty'));
                                        $totalPrice = number_format($totalPrice);
						            @endphp
                                    <td><a href="{{url('/member/order-history-detail/')}}/{{$value->id}}" style="color: blue;">{{$value->bill_number}}</a></td>
                                    <td>{{$value->date}}</td>
                                    <td>{{$qty}}</td>
                                    <td>{{$totalPrice}}.-</td>
                                    @php
                                        $status = DB::table('order_customer_confirms')->where('order_id',$value->id)->value('status');
                                    @endphp
                                    @if($status == null || $status == 'รอยืนยัน')
                                        <td style="color:red; font-size:15px;">รอยืนยัน</td> 
                                    @elseif($status == 'กำลังจัดส่ง')
                                        <td style="color:blue; font-size:15px;">กำลังจัดส่ง</td> 
                                    @else
                                        <td style="color:green; font-size:15px;">จัดส่งแล้ว</td>
                                    @endif
                                    <td><a href="{{url('/store/order-history-detail/')}}/{{$value->id}}" style="color: blue;">ตรวจสอบการสั่งซื้อ</a></td>
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
                <a href="{{url('/store/order-product')}}" class="btn-warranty" style="text-decoration: none;" >
                    เลือกซื้อสินค้า
                </a>
            </center>
        </div>
    </div>
@endif
@endsection