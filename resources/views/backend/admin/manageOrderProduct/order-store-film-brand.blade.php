@extends("/backend/layouts/template/template-admin")

@section("content")
<div class="main-body">
    <div class="page-wrapper">
        <div class="page-body">
            <div class="card table-card">
                <div class="card-header">
                    <h5>ค้นหาคำสั่งซื้อพร้อมแพ็คเกจของร้านค้า</h5>
                </div><br>
                <div class="card-block">
                    <form action="{{url('/admin/search-order-store-film-brand')}}" enctype="multipart/form-data" method="post">@csrf
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
                    <h5>ข้อมูลการสั่งซื้อสินค้าพร้อมแพ็คเกจของร้านค้า</h5>
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
                                    <th>ราคารวม</th>
                                    <th>สถานะ</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order => $value)
                                    <tr>
                                        <th scope="row">{{$NUM_PAGE*($page-1) + $order+1}}</th>
                                        @php
                                            $qty = DB::table('product_cart_store_film_brands')->where('bill_number',$value->bill_number)->sum('qty');
                                            $totalPrice = DB::table('product_cart_store_film_brands')->where('bill_number',$value->bill_number)
                                                                                                     ->sum(DB::raw('price * qty'));
                                            $totalPrice = number_format($totalPrice);
                                            $store_id = DB::table('stores')->where('id',$value->store_id)->value('store_id')
                                        @endphp
                                        <td>{{$store_id}}</td>
                                        <td><a href="{{url('/admin/order-store-detail/film-brand')}}/{{$value->id}}" style="color: blue;">{{$value->bill_number}}</a></td>
                                        <td>{{$value->date}}</td>
                                        <td>{{$qty}}</td>
                                        <td>{{$totalPrice}}.-</td>
                                        <td>
                                            @php
                                                $status = DB::table('order_store_confirm_film_brands')->where('order_id',$value->id)->value('status');
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
                                            <a href="{{url('/admin/order-store-detail/film-brand')}}/{{$value->id}}" style="color: blue;">
                                                ตรวจสอบการสั่งซื้อ
                                            </a>
                                        </td>
                                        <td>
                                            @if($status == null || $status == 'รอยืนยัน')
                                                <a href="{{url('/admin/delete-order-store-film-brand/')}}/{{$value->id}}" style="color: red;" onclick="return confirm('ต้องการยกเลิกคำสั่งซื้อ ?')">
                                                    ยกเลิกการสั่งซื้อ
                                                </a>
                                            @elseif($status == 'กำลังจัดส่ง')
                                                <p style="color:red; font-size:15px;">ไม่สามารถยกเลิกคำสั่งซื้อได้</p>
                                            @else
                                                <p style="color:red; font-size:15px;">ไม่สามารถยกเลิกคำสั่งซื้อได้</p>
                                            @endif
                                            
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