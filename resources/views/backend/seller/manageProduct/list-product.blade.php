@extends("/backend/layouts/template/template-seller")

@section("content")
<div class="main-body">
    <div class="page-wrapper">
        <div class="page-body">
            <div class="card">
                <div class="card-header">
                    <h5>ข้อมูลสินค้า</h5>
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
                                    <th>ยี่ห้อโทรศัพท์</th>
                                    <th>รุ่น</th>
                                    <th>ประเภทสินค้า</th>
                                    <th>ชื่อสินค้า</th>
                                    <th>สถานะ</th>
                                    <th>แนะนำ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product => $value)
                                    <tr>
                                        <th scope="row">{{$NUM_PAGE*($page-1) + $product+1}}</th>
                                        @php
                                            $category = DB::table('categorys')->where('id',$value->category_id)->value('category');
                                            $brand = DB::table('brands')->where('id',$value->brand_id)->value('brand');
                                            $model = DB::table('phone_models')->where('id',$value->phone_model_id)->value('model');
                                        @endphp
                                        <td>{{$value->product_code}}</td>
                                        <td>{{$category}}</td>
                                        <td>{{$brand}}</td>
                                        <td>{{$model}}</td>
                                        <td>{{$value->product_type}}</td>
                                        <td>{{$value->product_name}}</td>
                                        <td>{{$value->status}}</td>
                                        @if($value->product_recommend == 'ใช่')
                                            <td><i class="fa fa-check" style="color: green !important;"></i></td>
                                        @else 
                                            <td><i class="fa fa-times" style="color: red !important;"></i></td>
                                        @endif
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