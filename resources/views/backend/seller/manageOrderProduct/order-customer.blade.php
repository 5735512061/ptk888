@extends("/backend/layouts/template/template-seller")

@section("content")
<div class="main-body">
    <div class="page-wrapper">
        <div class="page-body">
            <div class="card">
                <div class="card-header">
                    <h5>ข้อมูลการสั่งซื้อของลูกค้า</h5>
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
                                    <th>บิลเลขที่</th>
                                    <th>วันที่สั่งซื้อ</th>
                                    <th>จำนวน</th>
                                    <th>ราคารวม</th>
                                    <th>สถานะ</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order => $value)
                                    <tr>
                                        <th scope="row">{{$NUM_PAGE*($page-1) + $order+1}}</th>
                                        @php
                                            $qty = DB::table('product_cart_customers')->where('id',$value->product_cart_id)->value('qty');
                                            $price = DB::table('product_cart_customers')->where('id',$value->product_cart_id)->value('price');
                                            $totalPrice = number_format($qty * $price);
                                        @endphp
                                        <td><a href="{{url('/seller/order-customer-detail/')}}/{{$value->id}}" style="color: blue;">{{$value->bill_number}}</a></td>
                                        <td>{{$value->date}}</td>
                                        <td>{{$qty}}</td>
                                        <td>{{$totalPrice}}.-</td>
                                        <td></td>
                                        <td>       
                                            <a href="{{url('/seller/edit-product')}}/{{$value->id}}">
                                                <i class="fa fa-pencil-square-o" style="color:blue; font-family: 'Mitr','FontAwesome';"> ตรวจสอบการสั่งซื้อ</i>
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