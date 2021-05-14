@extends("/frontend/layouts/template/template")

@section("content")
<!-- Checkout Start -->
<form action="{{url('/member/payment-checkout-customer')}}" enctype="multipart/form-data" method="post">@csrf
<div class="checkout">
    <div class="container-fluid"> 
        <div class="row">
            <div class="col-lg-8">
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if(Session::has('alert-' . $msg))
                        <p class="alertdesign alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                    @endif
                @endforeach
                <div class="checkout-inner">
                    <div class="billing-address">
                        <h2>@lang('checkout.shippingAddress')</h2>
                        <div class="row">
                            <div class="col-md-6">
                                <label>@lang('checkout.name')</label>
                                @if ($errors->has('name'))
                                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('name') }})</span>
                                @endif
                                <input class="form-control" type="text" placeholder="@lang('placeholder.fname_lname')" name="name">
                            </div>
                            <div class="col-md-6">
                                <label>@lang('checkout.mobile')</label>
                                @if ($errors->has('phone'))
                                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('phone') }})</span>
                                @endif
                                <input class="phone_format form-control" type="text" placeholder="@lang('placeholder.mobile')" name="phone">
                            </div>
                            <div class="col-md-6">
                                <label>@lang('checkout.mobile_2')</label>
                                <input class="phone_format form-control" type="text" placeholder="@lang('placeholder.mobile_2')" name="phone_sec">
                            </div>
                            <div class="col-md-12">
                                <label>@lang('checkout.address')</label>
                                @if ($errors->has('address'))
                                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('address') }})</span>
                                @endif
                                <input class="form-control" type="text" placeholder="@lang('placeholder.address')" name="address">
                            </div>
                            <div class="col-md-6">
                                <label>@lang('checkout.sub_district')</label>
                                @if ($errors->has('district'))
                                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('district') }})</span>
                                @endif
                                <input class="form-control" type="text" placeholder="@lang('placeholder.subDistrict')" name="district">
                            </div>
                            <div class="col-md-6">
                                <label>@lang('checkout.district')</label>
                                @if ($errors->has('amphoe'))
                                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('amphoe') }})</span>
                                @endif
                                <input class="form-control" type="text" placeholder="@lang('placeholder.district')" name="amphoe">
                            </div>
                            <div class="col-md-6">
                                <label>@lang('checkout.province')</label>
                                @if ($errors->has('province'))
                                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('province') }})</span>
                                @endif
                                <input class="form-control" type="text" placeholder="@lang('placeholder.province')" name="province">
                            </div>
                            <div class="col-md-6">
                                <label>@lang('checkout.zipcode')</label>
                                @if ($errors->has('zipcode'))
                                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('zipcode') }})</span>
                                @endif
                                <input class="form-control" type="text" placeholder="@lang('placeholder.zipcode')" name="zipcode">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-4">
                <div class="checkout-inner">
                    <div class="checkout-summary">
                        <h1>@lang('checkout.orderTotal')</h1>
                        @php
                            $totalPrice = 0;
                        @endphp
                        @foreach($products as $product)
                            @php 
                                $id = $product['item'];
                                
                                if(\Session::get('locale') == "th")
                                    $name = DB::table('products')->where('id',$id)->value('product_name_th'); 
                                elseif(\Session::get('locale') == "en")
                                    $name = DB::table('products')->where('id',$id)->value('product_name_en'); 
                                else
                                    $name = DB::table('products')->where('id',$id)->value('product_name_th');
                                $price = $product['price']/$product['qty'];
                                $totalPrice += $product['price'];
                            @endphp
                            <input type="hidden" value="{{ $name }}" name="product[]">
                            <input type="hidden" value="{{ $price }}" name="price[]">
                            <input type="hidden" value="{{ $product['qty'] }}" name="qty[]">
                            <input type="hidden" value="{{ $product['item'] }}" name="product_id[]">
                        @endforeach
                        <p>@lang('checkout.total')<span>{{ number_format($totalPrice) }} @lang('checkout.thb')</span></p>
                        <h2>@lang('checkout.subTotal')<span>{{ number_format($totalPrice) }} @lang('checkout.thb')</span></h2>
                    </div>

                    <div class="checkout-payment">
                        <div class="payment-methods">
                            <h1>@lang('checkout.paymentDetail')</h1>
                            <p>@lang('checkout.kasikornBank')</p>
                            <p>@lang('checkout.accountNumber') : 072-2-27925-5</p>
                            <p>@lang('checkout.accountName')</p>
                            @if ($errors->has('money'))
                                <span class="text-danger" style="font-size: 17px;">({{ $errors->first('money') }})</span>
                            @endif
                            <input class="form-control" type="text" placeholder="* @lang('placeholder.money')" style="font-size: 14px;" name="money">
                            @if ($errors->has('payday'))
                                <span class="text-danger" style="font-size: 17px;">({{ $errors->first('payday') }})</span>
                            @endif
                            <input class="form-control" type="text" placeholder="* @lang('placeholder.payday')" style="font-size: 14px;" name="payday">
                            @if ($errors->has('time'))
                                <span class="text-danger" style="font-size: 17px;">({{ $errors->first('time') }})</span>
                            @endif
                            <input class="form-control" type="text" placeholder="* @lang('placeholder.time')" style="font-size: 14px;" name="time">
                            <label class="col-form-label">@lang('checkout.attachPaymentSlip')</label>
                            @if ($errors->has('slip'))
                                <span class="text-danger" style="font-size: 17px;">({{ $errors->first('slip') }})</span>
                            @endif
                            <input type="file" class="form-control" name="slip">
                        </div>
                        <div class="checkout-btn">
                            <button type="submit">@lang('checkout.paymentNotification')</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Checkout End -->
</form>
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