@extends("/backend/layouts/template/template-store")
<style>
    .table td {
        padding: 0px !important;
    }
</style>
@section("content")
<div class="container-fluid">
    <br><center><h2>ประวัติการสั่งซื้อสินค้าพร้อมแพ็คเกจ<hr width="70px;" style="border-top:5px solid rgb(255 194 49 / 47%)"></h2></center>
</div><br>
@if(count($orders) != 0)
<!-- Cart Start -->

<div class="main-body">
    <div class="page-wrapper">
        <div class="page-body">
            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                @if(Session::has('alert-' . $msg))
                    <p class="alertdesign alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                @endif
            @endforeach
            <div class="card">
                <div class="card-header">
                    <h5>ประวัติการสั่งซื้อสินค้าพร้อมแพ็คเกจ</h5>
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
                                    <td>บิลเลขที่</td>
                                    <td>วันที่ทำรายการ</td>
                                    <td>จำนวน</td>
                                    <td>ราคารวม</td>
                                    <td>สถานะ</td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order => $value)
                                    <tr>
                                        @php 
                                            $qty = DB::table('product_cart_store_film_brands')->where('bill_number',$value->bill_number)->sum('qty');
                                            $totalPrice = DB::table('product_cart_store_film_brands')->where('bill_number',$value->bill_number)
                                                                                                     ->sum(DB::raw('price * qty'));
                                            $totalPrice = number_format($totalPrice);
						                @endphp
                                        <td><a href="{{url('/store/order-history-detail/film-brand')}}/{{$value->id}}" style="color: blue;">{{$value->bill_number}}</a></td>
                                        <td>{{$value->date}}</td>
                                        <td>{{$qty}} ชิ้น</td>
                                        <td>{{$totalPrice}}.-</td>
                                        @php
                                            $status = DB::table('order_store_confirm_film_brands')->where('order_id',$value->id)->value('status');
                                        @endphp
                                        @if($status == null || $status == 'รอยืนยัน')
                                            <td style="color:red; font-size:15px;">รอยืนยัน</td> 
                                        @elseif($status == 'กำลังจัดส่ง')
                                            <td style="color:blue; font-size:15px;">กำลังจัดส่ง</td> 
                                        @else
                                            <td style="color:green; font-size:15px;">จัดส่งแล้ว</td>
                                        @endif
                                        <td><a href="{{url('/store/order-history-detail/film-brand')}}/{{$value->id}}" style="color: blue;">ตรวจสอบการสั่งซื้อ</a></td>
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
<!-- Cart End -->
@else 
    <div class="cart-page">
        <div class="container-fluid">
            <!-- Cart item -->
            <h5 class="m-text20 p-b-24" style="text-align: center;">
                ไม่มีประวัติการสั่งซื้อสินค้า! 
            </h5><br>
            <center>
                <a href="{{url('/store/order-product')}}" class="btn btn-primary">
                    สั่งซื้อสินค้า
                </a>
            </center>
        </div>
    </div>
@endif
@endsection