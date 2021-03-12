@extends("/frontend/layouts/template/template")

@section("content")
<!-- Checkout Start -->
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
                                <input class="form-control" type="text" placeholder="กรุณากรอกชื่อและนามสกุล">
                            </div>
                            <div class="col-md-6">
                                <label>เบอร์โทรศัพท์</label>
                                <input class="form-control" type="text" placeholder="กรุณากรอกเบอร์โทรศัพท์">
                            </div>
                            <div class="col-md-12">
                                <label>ที่อยู่</label>
                                <input class="form-control" type="text" placeholder="กรุณากรอกที่อยู่ หมู่บ้าน ถนน หรือตรอก/ซอย (ถ้ามี)">
                            </div>
                            <div class="col-md-6">
                                <label>ตำบล</label>
                                <input class="form-control" type="text" placeholder="กรุณากรอกตำบล">
                            </div>
                            <div class="col-md-6">
                                <label>อำเภอ</label>
                                <input class="form-control" type="text" placeholder="กรุณากรอกอำเภอ">
                            </div>
                            <div class="col-md-6">
                                <label>จังหวัด</label>
                                <input class="form-control" type="text" placeholder="กรุณากรอกจังหวัด">
                            </div>
                            <div class="col-md-6">
                                <label>รหัสไปรษณีย์</label>
                                <input class="form-control" type="text" placeholder="กรุณากรอกรหัสไปรษณีย์">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-4">
                <div class="checkout-inner">
                    <div class="checkout-summary">
                        <h1>สรุปยอดการสั่งซื้อสินค้า</h1>
                        <p>ยอดสินค้า<span>{{ number_format($total) }} บาท</span></p>
                        <h2>รวมทั้งสิ้น<span>{{ number_format($total) }} บาท</span></h2>
                    </div>

                    <div class="checkout-payment">
                        <div class="payment-methods">
                            <h1>รายละเอียดการชำระเงิน</h1>
                        </div>
                        <div class="checkout-btn">
                            <button>แจ้งชำระเงิน</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Checkout End -->
    
@endsection