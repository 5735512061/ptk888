@extends("/frontend/layouts/template/template-index")

@section("content")
        <!-- Main Slider Start -->
        <div class="container-fluid">
            <div class="header" style="background-color: #fff;">
                <div class="row">
                    <div class="col-md-12">
                        <div class="header-slider normal-slider">
                            @foreach ($images as $image => $value)
                                <div class="header-slider-item">
                                    <img src="{{url('/image_upload/image_website')}}/{{$value->image}}" class="img-responsive" width="100%"/>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div><br>
        <!-- Main Slider End -->      
        
        <!-- Brand Start -->
        @php
            $brands = DB::table('brands')->get();
        @endphp
        <div class="container-fluid">
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
            </div>
        </div>
        <!-- Brand End -->       

        <!-- Newsletter Start -->
        {{-- <div class="container-fluid">
            <div class="newsletter">
                <div class="row">
                    <div class="col-md-12">
                        <center><a href="{{url('/member/register-warranty')}}"><h1>ลงทะเบียนรับประกันฟิล์ม</h1></center></a>
                    </div>
                </div>
            </div>
        </div> --}}
        <!-- Newsletter End -->   
        
        <!-- Featured Product Start -->
        <div class="featured-product product">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-2 col-12 section-header" style="text-align: center;">
                        <h2>สินค้าแนะนำ<hr class="col-md-1 col-1" style="border-top:5px solid rgba(0,0,0,36%);"></h2>
                    </div>
                    <div class="col-md-5"></div>
                </div>
                
                <div class="row align-items-center product-slider product-slider-4" style="margin-top: 2rem;">
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
                            <div class="product-image">
                                <a href="#">
                                    <img src="{{url('img/productRecommend/productRecommend1.jpg')}}" alt="Product Image">
                                </a>
                            </div>
                            <h5 style="font-weight: bold; padding:1.5rem;">WOLVERINE Self Repair ซ่อมแซมตัวเองภายใน 24 ชั่วโมง</h5>
                            <div class="product-price">
                                <h5 style="font-weight: bold; padding-left:0.5rem;">ราคา 790 บาท</h5>
                            </div>
                        </div>
                    </div>
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
                            <div class="product-image">
                                <a href="#">
                                    <img src="{{url('img/productRecommend/productRecommend6.png')}}" alt="Product Image">
                                </a>
                            </div>
                            <h5 style="font-weight: bold; padding:1.5rem;">WOLVERINE Self Repair ซ่อมแซมตัวเองภายใน 24 ชั่วโมง</h5>
                            <div class="product-price">
                                <h5 style="font-weight: bold; padding-left:0.5rem;">ราคา 790 บาท</h5>
                            </div>
                        </div>
                    </div>
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
                            <div class="product-image">
                                <a href="#">
                                    <img src="{{url('img/productRecommend/productRecommend7.png')}}" alt="Product Image">
                                </a>
                            </div>
                            <h5 style="font-weight: bold; padding:1.5rem;">WOLVERINE Self Repair ซ่อมแซมตัวเองภายใน 24 ชั่วโมง</h5>
                            <div class="product-price">
                                <h5 style="font-weight: bold; padding-left:0.5rem;">ราคา 790 บาท</h5>
                            </div>
                        </div>
                    </div>
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
                            <div class="product-image">
                                <a href="#">
                                    <img src="{{url('img/productRecommend/productRecommend8.png')}}" alt="Product Image">
                                </a>
                            </div>
                            <h5 style="font-weight: bold; padding:1.5rem;">WOLVERINE Self Repair ซ่อมแซมตัวเองภายใน 24 ชั่วโมง</h5>
                            <div class="product-price">
                                <h5 style="font-weight: bold; padding-left:0.5rem;">ราคา 790 บาท</h5>
                            </div>
                        </div>
                    </div>
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
                            <div class="product-image">
                                <a href="#">
                                    <img src="{{url('img/productRecommend/productRecommend4.jpg')}}" alt="Product Image">
                                </a>
                            </div>
                            <h5 style="font-weight: bold; padding:1.5rem;">HYDROGEL FILM ชนิดด้าน สำหรับ iPhone 12</h5>
                            <div class="product-price">
                                <h5 style="font-weight: bold; padding-left:0.5rem;">ราคา 790 บาท</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Featured Product End -->            
        
        <!-- Recent Product Start -->
        <div class="recent-product product">
            <div class="container-fluid">
                <div class="row">
                    <div class=" col-md-2 col-12 section-header" style="text-align: center;">
                        <h2>สินค้าใหม่<hr class="col-md-1 col-1" style="border-top:5px solid rgba(0,0,0,36%);"></h2>
                    </div>
                    <div class="col-md-5"></div>
                </div>
                <div class="row align-items-center">
                    <div class="col-lg-4">
                        <div class="product-item">
                            <div class="product-image">
                                <img src="{{url('img/productNew/productNew1.jpg')}}" alt="Product Image">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="product-item">
                            <div class="product-image">
                                <img src="{{url('img/productNew/productNew2.jpg')}}" alt="Product Image">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="product-item">
                            <div class="product-image">
                                <img src="{{url('img/productNew/productNew3.jpg')}}" alt="Product Image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Recent Product End -->      
@endsection