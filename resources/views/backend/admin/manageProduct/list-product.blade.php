@extends("/backend/layouts/template/template-admin")

@section("content")
<div class="main-body">
    <div class="page-wrapper">
        <div class="page-body">
            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                @if(Session::has('alert-' . $msg))
                    <p class="alertdesign alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                @endif
            @endforeach
            <div class="card table-card">
                <div class="card-header">
                    <h5>ค้นหารายการสินค้า</h5>
                </div><br>
                <div class="card-block">
                    <form action="{{url('/admin/search-list-product')}}" enctype="multipart/form-data" method="post">@csrf
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
                                <input type="text" name="product_type" class="form-control" placeholder="ค้นหาประเภทฟิล์ม"><br>
                                <button type="submit" class="btn btn-mat waves-effect waves-light btn-primary">ค้นหาประเภทฟิล์ม</button>
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
                    <h5>รายการสินค้าทั้งหมด</h5>
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
                                    <th>ผลิตภัณฑ์</th>
                                    <th>ยี่ห้อฟิล์ม</th>
                                    <th>ยี่ห้อโทรศัพท์</th>
                                    <th>รุ่น</th>
                                    <th>ประเภทสินค้า</th>
                                    <th>ชื่อสินค้า (ภาษาไทย)</th>
                                    <th>ชื่อสินค้า (ภาษาอังกฤษ)</th>
                                    <th>สถานะ</th>
                                    <th>แนะนำ</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product => $value)
                                    <tr>
                                        <th scope="row">{{$NUM_PAGE*($page-1) + $product+1}}</th>
                                        @php
                                            $category = DB::table('categorys')->where('id',$value->category_id)->value('category_th');
                                            $brand = DB::table('brands')->where('id',$value->brand_id)->value('brand');
                                            $model = DB::table('phone_models')->where('id',$value->phone_model_id)->value('model');
                                        @endphp
                                        <td>{{$value->product_code}}</td>
                                        <td>{{$category}}</td>
                                        <td>{{$value->film_model}}</td>
                                        <td>{{$brand}}</td>
                                        <td>{{$model}}</td>
                                        <td>{{$value->product_type}}</td>
                                        <td>{{$value->product_name_th}}</td>
                                        <td>{{$value->product_name_en}}</td>
                                        <td>{{$value->status}}</td>
                                        @if($value->product_recommend == 'ใช่')
                                            <td><i class="fa fa-check" style="color: green !important;"></i></td>
                                        @else 
                                            <td><i class="fa fa-times" style="color: red !important;"></i></td>
                                        @endif
                                        <td>       
                                            <a href="{{url('/admin/edit-product')}}/{{$value->id}}">
                                                <i class="fa fa-pencil-square-o" style="color:blue;"></i>
                                            </a>        
                                            <a href="{{url('/admin/delete-product/')}}/{{$value->id}}" onclick="return confirm('Are you sure to delete ?')">
                                                <i class="fa fa-trash" style="color:red;"></i>
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