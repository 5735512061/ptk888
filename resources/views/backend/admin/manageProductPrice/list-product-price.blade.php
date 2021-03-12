@extends("/backend/layouts/template/template-admin")

@section("content")
<div class="main-body">
    <div class="page-wrapper">
        <div class="page-body">
            <div class="card">
                <div class="card-header">
                    <h5>ข้อมูลราคาสินค้า</h5>
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
                                    <th>ชื่อสินค้า</th>
                                    <th>ราคาล่าสุด</th>
                                    <th>สถานะ</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product => $value)
                                    <tr>
                                        <th scope="row">{{$NUM_PAGE*($page-1) + $product+1}}</th>
                                        @php 
                                            $price = DB::table('product_prices')->where('product_id',$value->id)->orderBy('id','desc')->value('price');
                                            $status = DB::table('product_prices')->where('product_id',$value->id)->value('status');
                                        @endphp
                                        <td>{{$value->product_code}}</td>
                                        <td>{{$value->product_name}}</td>
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
                                            <a href="{{url('/admin/edit-product-price')}}/{{$value->id}}">
                                                <i class="fa fa-pencil-square-o" style="color:blue;"></i>
                                            </a> 
                                            <a href="{{url('/admin/product-price-detail')}}/{{$value->id}}">
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