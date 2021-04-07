@extends("/frontend/layouts/template/template")

@section("content")
@if($category == "กระจกกันรอย" || $category == "หูฟังไร้สาย" || $category == "POWER BANK")
    <div class="featured-product product">
        <div class="container-fluid">
            @if($category == "กระจกกันรอย")
                <center><h2>กระจกกันรอย<hr class="col-md-1 col-1" style="border-top:5px solid rgb(255 194 49 / 47%)"></h2></center>
            @elseif($category == "หูฟังไร้สาย")
                <center><h2>หูฟังไร้สาย<hr class="col-md-1 col-1" style="border-top:5px solid rgb(255 194 49 / 47%)"></h2></center>
            @elseif($category == "POWER BANK")
                <center><h2>POWER BANK<hr class="col-md-1 col-1" style="border-top:5px solid rgb(255 194 49 / 47%)"></h2></center>
            @endif
            <h5 style="text-align: center;">-- สินค้ายังไม่มีจำหน่าย กรุณาติดตามสินค้าได้ที่เว็บไซต์ --</h5><hr>
        </div>
    </div>
    <!-- Featured Product Start -->
    <div class="featured-product product">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 col-12 section-header" style="text-align: center;">
                    <h2>สินค้าแนะนำอื่นๆ<hr class="col-md-1 col-1" style="border-top:5px solid rgba(0,0,0,36%);"></h2>
                </div>
                <div class="col-md-5"></div>
            </div>
            
            <div class="row align-items-center product-slider product-slider-4" style="margin-top: 2rem;">
                @foreach ($productRecommends as $productRecommend => $value)
                    <div class="col-lg-3">
                        <div class="product-item">
                            <div class="product-title">
                                <div class="ratting">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                            </div>
                            @php
                                $image = DB::table('image_products')->where('product_id',$value->id)->value('image');
                                $brand = DB::table('brands')->where('id',$value->brand_id)->value('brand');
                                $model = DB::table('phone_models')->where('id',$value->phone_model_id)->value('model');
                                $price = DB::table('product_prices')->where('product_id',$value->id)->where('status','เปิด')->orderBy('id','desc')->value('price');
                            @endphp
                            <a href="{{url('/product')}}/{{$brand}}/{{$model}}/detail/{{$value->id}}">
                                <div class="product-image">
                                    <img src="{{url('/image_upload/image_product')}}/{{$image}}" width="100%">
                                </div>
                                <div class="text-intro">
                                    <h5 style="font-weight: bold; padding:1.5rem;">{{$value->product_name}}</h5>
                                </div>
                            </a>
                            <div class="product-price">
                                @if($price == null)
                                    <h5 style="font-weight: bold; padding-left:0.5rem;">ราคา 0 บาท</h5>
                                @else
                                    <h5 style="font-weight: bold; padding-left:0.5rem;">ราคา {{$price}} บาท</h5>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Featured Product End -->
@elseif($category == "ฟิล์มไฮโดรเจล")
<div class="featured-product product">
    <div class="container-fluid">
        <center><h2>ฟิล์มไฮโดรเจล<hr class="col-md-1 col-1" style="border-top:5px solid rgb(255 194 49 / 47%)"></h2></center>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <h5 style="line-height: 1.7;"><strong>ฟิล์มไฮโดรเจล</strong> เป็นฟิล์มกันรอยรูปแบบใหม่ที่มีจุดเด่นเป็นความบางเฉียบที่แข็งแรงทนทาน ติดเคลือบป้องกันได้ทั้งตัว ติดแน่นหนึบ อีกทั้งยังไม่บดบังความคมชัด 
                    หรือสีสันของหน้าจอ พร้อมความแข็งแรง ทนทานที่สามารถรับแรงกระแทกได้ในระดับหนึ่ง โดยติดใช้งานได้ไม่ยาก พร้อมไม่ทิ้งฟองอากาศ หรือคราบกาว</h5>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
    <div class="container-fluid">
        @php
            $brands = DB::table('brands')->get();
        @endphp
        <div class="brand">
            <div class="brand-slider">
                @foreach ($brands as $brand => $value)
                <a href="{{url('/brand')}}/{{$value->brand_eng}}" style="border-right: 2px solid rgba(0,0,0,36%)">
                    <div class="brand-item">
                        <img src="{{url('/image_upload/image_brand')}}/{{$value->image}}" class="img-responsive" width="50%">
                    </div>
                </a>
                @endforeach
            </div>
        </div><hr>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-5">
                        <img src="{{url('img/logo_film/high_clear.jpg')}}" class="img-responsive">
                    </div>
                    <div class="col-md-7" style="margin-top: 5em;">
                        <strong>ฟิล์มไฮโดรเจลวูล์ฟเวอรีน-ฟื้นฟูตัวเอง (Wolverine Self Repair Hydrogel Film)</strong>
                        <p>ฟิล์มกันกระแทก ที่มีคุณสมบัติพิเศษที่ไม่เหมือนใคร คือการซ่อมแซมตัวเอง หลังจากเกิดรอยขีดข่วนหรือรอยพับ ให้กลับมาใสดังเดิม ภายใน 24 ชั่วโมง</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-5">
                        <img src="{{url('img/logo_film/high_clear.jpg')}}" class="img-responsive">
                    </div>
                    <div class="col-md-7" style="margin-top: 5em;">
                        <strong>ฟิล์มไฮโดรเจลกันรอยแบบป้องกันความเป็นส่วนตัว (Privacy Screen Hydrogel Film)</strong>
                        <p>ฟิล์มกันกระแทก ที่มีคุณสมบัติพิเศษคือ ผู้อื่นไม่สามารถมองเห็นหน้าจอของเราได้ ผู้ใช้จะสามารถมองจากมุมด้านหน้าตรง ๆ เท่านั้น เพื่อความเป็นส่วนตัว</p>
                    </div>
                </div>
            </div>
        </div><br>
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-5">
                        <img src="{{url('img/logo_film/high_clear.jpg')}}" class="img-responsive">
                    </div>
                    <div class="col-md-7" style="margin-top: 5em;">
                        <strong>ฟิล์มไฮโดรเจลกันรอยแบบป้องกันสายตา (Anti-Blue Light Hydrogel Film)</strong>
                        <p>ฟิล์มกันกระแทก ที่มีคุณสมบัติพิเศษคือป้องกันสายตา ตัดแสงสีฟ้าจากหน้าจอมือถือ</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-5">
                        <img src="{{url('img/logo_film/high_clear.jpg')}}" class="img-responsive">
                    </div>
                    <div class="col-md-7" style="margin-top: 5em;">
                        <strong>ฟิล์มไฮโดรเจลกันรอยแบบด้าน (Hydrogel Matte Film)</strong>
                        <p>ฟิล์มกันกระแทก ที่มีคุณสมบัติของฟิล์มชนิดนี้คือ ไม่ทิ้งคราบรอยนิ้วมือ และคราบเหงื่อ เหมาะสำหรับผู้ที่ชอบเล่นเกมส์ การสัมผัสหน้าจอและทัชสกรีนลื่นไหล ไม่สะดุด</p>
                    </div>
                </div>
            </div>
        </div><br>
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-5">
                        <img src="{{url('img/logo_film/high_clear.jpg')}}" class="img-responsive">
                    </div>
                    <div class="col-md-7" style="margin-top: 5em;">
                        <strong>ฟิล์มไฮโดรเจลกันรอยแบบใส (High Clear Hydrogel Film)</strong>
                        <p>ฟิล์มกันกระแทก ที่มีคุณสมบัติพิเศษคือแสงจอไม่ดรอปลง หน้าจอคงความสดใสได้ดังเดิมเสมือนไม่ได้ติดฟิล์มมาเลยทีเดียว</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection