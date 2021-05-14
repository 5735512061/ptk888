@extends("/frontend/layouts/template/template")

@section("content")
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-lg-8">
            <h3>@lang('orderHistoryDetail.orderDetails') @lang('orderHistoryDetail.billNumber') {{$order->bill_number}}</h3><br>
            <div class="row">
                <div class="col-md-6">
                    <h4>@lang('orderHistoryDetail.paymentInformation')</h4><hr style="border-top:3px solid rgb(214 214 214)">
                    @php
                        $payday = DB::table('payment_checkout_customers')->where('customer_id',$order->customer_id)->where('bill_number',$order->bill_number)->value('payday');
                        $time = DB::table('payment_checkout_customers')->where('customer_id',$order->customer_id)->where('bill_number',$order->bill_number)->value('time');
                        $money = DB::table('payment_checkout_customers')->where('customer_id',$order->customer_id)->where('bill_number',$order->bill_number)->value('money');
                    @endphp
                    <p style="font-size: 18px;">@lang('orderHistoryDetail.paymentDate') : {{$payday}} {{$time}}</p>
                    <p style="font-size: 18px;">@lang('orderHistoryDetail.total') : {{$money}} @lang('orderHistoryDetail.thb')</p>
                </div>
                <div class="col-md-6">
                    <h4>@lang('orderHistoryDetail.deliveryAddress')</h4><hr style="border-top:3px solid rgb(214 214 214)">
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
                    <p style="font-size: 16px;">@lang('orderHistoryDetail.address') {{$address}} @lang('orderHistoryDetail.sub_district') {{$district}} @lang('orderHistoryDetail.district') {{$amphoe}} @lang('orderHistoryDetail.province') {{$province}} {{$zipcode}}</p>
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>

<!-- Cart Start -->
<div class="cart-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-lg-8">
                <div class="cart-page-inner">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            @php
                                $NUM_PAGE = 10;
                                $product_ids = DB::table('product_cart_customers')->where('bill_number',$order->bill_number)->paginate($NUM_PAGE);
                                $page = \Request::input('page');
                                $page = ($page != null)?$page:1;
                            @endphp
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>@lang('orderHistoryDetail.productName')</th>
                                    <th>@lang('orderHistoryDetail.pricePerUnit')</th>
                                    <th>@lang('orderHistoryDetail.unit')</th>
                                    <th>@lang('orderHistoryDetail.subTotal')</th>
                                    <th>@lang('orderHistoryDetail.status')</th>
                                </tr>
                            </thead>
                            <tbody class="align-middle">
                                @foreach ($product_ids as $product_id => $value)
                                    <tr>
                                        <th scope="row">{{$NUM_PAGE*($page-1) + $product_id+1}}</th>
                                        @php
                                            if(\Session::get('locale') == "th")
                                                $product_name = DB::table('products')->where('id',$value->product_id)->value('product_name_th');
                                            elseif(\Session::get('locale') == "en")
                                                $product_name = DB::table('products')->where('id',$value->product_id)->value('product_name_en');

                                            $qty = DB::table('product_cart_customers')->where('id',$value->id)->value('qty');
                                            $price = DB::table('product_cart_customers')->where('id',$value->id)->value('price');
                                            $totalPrice = number_format($qty * $price);
                                        @endphp
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
                                                <p style="color: red; font-size:17px;">@lang('orderHistoryDetail.waitingToConfirm')</p>
                                            @elseif($status == 'กำลังจัดส่ง')
                                                <p style="color:blue; font-size:17px;">@lang('orderHistoryDetail.shipping')</p>
                                            @else
                                                <p style="color:green; font-size:17px;">@lang('orderHistoryDetail.delivered')</p>
                                            @endif
                                        </td>
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
@endsection