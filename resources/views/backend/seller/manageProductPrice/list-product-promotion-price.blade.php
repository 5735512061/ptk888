@extends("/backend/layouts/template/template-seller")

@section("content")
<div class="main-body">
    <div class="page-wrapper">
        <div class="page-body">
            <div class="card table-card">
                <div class="card-header">
                    <h5>ค้นหารายการราคาโปรโมชั่นสินค้า</h5>
                </div><br>
                <div class="card-block">
                    <form action="{{url('/seller/search-list-product-promotion-price')}}" enctype="multipart/form-data" method="post">@csrf
                        <div class="row" style="margin-left: 5px; margin-right: 5px;">
                            <div class="col-md-3">
                                <input type="text" name="product_code" class="form-control" placeholder="ค้นหารหัสสินค้า"><br>
                                <button type="submit" class="btn btn-mat waves-effect waves-light btn-primary">ค้นหารหัสสินค้า</button>
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="product_name" class="form-control" placeholder="ค้นหาชื่อสินค้า"><br>
                                <button type="submit" class="btn btn-mat waves-effect waves-light btn-primary">ค้นหาชื่อสินค้า</button>
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="film_model" class="form-control" placeholder="ค้นหายี่ห้อฟิล์ม"><br>
                                <button type="submit" class="btn btn-mat waves-effect waves-light btn-primary">ค้นหายี่ห้อฟิล์ม</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h5>จัดการราคาโปรโมชั่น</h5>
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
                                    <th>รหัสสินค้า</th>
                                    <th>ยี่ห้อฟิล์ม</th>
                                    <th>รุ่นโทรศัพท์</th>
                                    <th>ชื่อสินค้า</th>
                                    <th>โปรโมชั่นล่าสุด</th>
                                    <th>สถานะ</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product => $value)
                                    <tr>
                                        <th scope="row">{{$NUM_PAGE*($page-1) + $product+1}}</th>
                                        @php 
                                            $price = DB::table('product_promotion_prices')->where('product_id',$value->id)->orderBy('id','desc')->value('promotion_price');
                                            $status = DB::table('product_promotion_prices')->where('product_id',$value->id)->value('status');
                                            $phone_model = DB::table('phone_models')->where('id',$value->phone_model_id)->value('model');
                                        @endphp
                                        <td>{{$value->product_code}}</td>
                                        <td>{{$value->film_model}}</td>
                                        <td>{{$phone_model}}</td>
                                        <td>{{$value->product_name_th}}</td>
                                        @if($price == null)
                                            <td style="color: red;">0</td>
                                        @else 
                                            <td>{{$price}}.-</td>
                                        @endif

                                        @if($status == null)
                                            <td style="color: green;">เปิด</td>
                                        @else
                                            @if($status == 'เปิด')
                                                <td style="color: green;">{{$status}}</td>
                                            @else 
                                                <td style="color:red;">{{$status}}</td>
                                            @endif
                                        @endif
                                        <td>       
                                            <a href="{{url('/seller/edit-product-promotion-price')}}/{{$value->id}}">
                                                <i class="fa fa-pencil-square-o" style="color:blue;"></i>
                                            </a> 
                                            <a href="{{url('/seller/product-promotion-price-detail')}}/{{$value->id}}">
                                                <i class="fa fa-folder" style="color:blue;"></i>
                                            </a>        
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            {{$products->links()}}
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection