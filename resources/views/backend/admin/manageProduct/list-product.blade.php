@extends("/backend/layouts/template/template-admin")

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
                                    <th>ผลิตภัณฑ์</th>
                                    <th>ยี่ห้อ</th>
                                    <th>รหัสสินค้า</th>
                                    <th>ประเภทสินค้า</th>
                                    <th>ชื่อสินค้า</th>
                                    <th>สถานะ</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product => $value)
                                    <tr>
                                        <th scope="row">{{$NUM_PAGE*($page-1) + $product+1}}</th>
                                        @php
                                            $category = DB::table('categorys')->where('id',$value->category_id)->value('category');
                                            $brand = DB::table('brands')->where('id',$value->brand_id)->value('brand');
                                        @endphp
                                        <td>{{$category}}</td>
                                        <td>{{$brand}}</td>
                                        <td>{{$value->product_code}}</td>
                                        <td>{{$value->product_type}}</td>
                                        <td>{{$value->product_name}}</td>
                                        <td>{{$value->status}}</td>
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