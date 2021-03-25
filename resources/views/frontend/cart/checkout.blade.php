@extends("/frontend/layouts/template/template")

@section("content")
<!-- Checkout Start -->
<form action="{{url('/member/payment-checkout-customer')}}" enctype="multipart/form-data" method="post">@csrf
<div class="checkout">
    <div class="container-fluid"> 
        <div class="row">
            <div class="col-lg-8">
                <div class="checkout-inner">
                    <div class="billing-address">
                        <h2>ที่อยู่ในการจัดส่งสินค้า</h2>
                        <div class="row">
                            <div class="col-md-6">
                                <label>ชื่อ-นามสกุล</label>
                                <input class="form-control" type="text" placeholder="กรุณากรอกชื่อและนามสกุล" name="name">
                            </div>
                            <div class="col-md-6">
                                <label>เบอร์โทรศัพท์</label>
                                <input class="phone_format form-control" type="text" placeholder="กรุณากรอกเบอร์โทรศัพท์" name="phone">
                            </div>
                            <div class="col-md-6">
                                <label>เบอร์โทรศัพท์ (ถ้ามี)</label>
                                <input class="phone_format form-control" type="text" placeholder="กรุณากรอกเบอร์โทรศัพท์สำรอง (ถ้ามี)" name="phone_sec">
                            </div>
                            <div class="col-md-12">
                                <label>ที่อยู่</label>
                                <input class="form-control" type="text" placeholder="กรุณากรอกที่อยู่ หมู่บ้าน ถนน หรือตรอก/ซอย (ถ้ามี)" name="address">
                            </div>
                            <div class="col-md-6">
                                <label>ตำบล</label>
                                <input class="form-control" type="text" placeholder="กรุณากรอกตำบล" name="district">
                            </div>
                            <div class="col-md-6">
                                <label>อำเภอ</label>
                                <input class="form-control" type="text" placeholder="กรุณากรอกอำเภอ" name="amphoe">
                            </div>
                            <div class="col-md-6">
                                <label>จังหวัด</label>
                                <input class="form-control" type="text" placeholder="กรุณากรอกจังหวัด" name="province">
                            </div>
                            <div class="col-md-6">
                                <label>รหัสไปรษณีย์</label>
                                <input class="form-control" type="text" placeholder="กรุณากรอกรหัสไปรษณีย์" name="zipcode">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-4">
                <div class="checkout-inner">
                    <div class="checkout-summary">
                        <h1>สรุปยอดการสั่งซื้อสินค้า</h1>
                        @foreach($products as $product)
                            @php 
                                $id = $product['item'];
                                $name = DB::table('products')->where('id',$id)->value('product_name'); 
                                $price = DB::table('product_prices')->where('product_id',$id)->value('price'); 
                            @endphp
                            <input type="hidden" value="{{ $name }}" name="product[]">
                            <input type="hidden" value="{{ $price }}" name="price[]">
                            <input type="hidden" value="{{ $product['qty'] }}" name="qty[]">
                            <input type="hidden" value="{{ $product['item'] }}" name="product_id[]">
                        @endforeach
                        <p>ยอดสินค้า<span>{{ number_format($total) }} บาท</span></p>
                        <h2>รวมทั้งสิ้น<span>{{ number_format($total) }} บาท</span></h2>
                    </div>

                    <div class="checkout-payment">
                        <div class="payment-methods">
                            <h1>รายละเอียดการชำระเงิน</h1>
                            <p>เลขที่บัญชี : 123-456-789-0</p>
                            <p>ธนาคารไทยพาณิชย์</p>
                            <p>ชื่อบัญชี : บริษัท พีทีเค 888 จำกัด</p>
                            <input class="form-control" type="text" placeholder="* จำนวนเงิน ตัวอย่าง 790 บาท" style="font-size: 14px;" name="money">
                            <input class="form-control" type="text" placeholder="* วันที่ชำระเงิน ตัวอย่าง 01/01/2564" style="font-size: 14px;" name="payday">
                            <input class="form-control" type="text" placeholder="* เวลาชำระเงิน ตัวอย่าง 14.30น." style="font-size: 14px;" name="time">
                            <div class="custom-file">
                                <input type="file" class="slip custom-file-input" id="inputGroupFile04" name="slip">
                                <label class="custom-file-label m-text14" for="inputGroupFile04" style="font-size: 14px;">อัพโหลดหลักฐานการโอนเงิน</label>
                            </div>
                        </div>
                        <div class="checkout-btn">
                            <button type="submit">แจ้งชำระเงิน</button>
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