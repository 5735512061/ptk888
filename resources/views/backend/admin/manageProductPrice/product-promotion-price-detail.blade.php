@extends("/backend/layouts/template/template-admin")

@section("content")
<div class="main-body">
    <div class="page-wrapper">
        <div class="page-body">
            <div class="card">
                <div class="card-header">
                    <h5>ข้อมูลโปรโมชั่นสินค้า {{$product}}</h5>
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
                                    <th>วันที่อัพเดตราคา</th>
                                    <th>โปรโมชั่นล่าสุด</th>
                                    <th>สถานะ</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product_prices as $product_price => $value)
                                    <tr>
                                        <th scope="row">{{$NUM_PAGE*($page-1) + $product_price+1}}</th>
                                        <td>{{ date('Y-m-d', strtotime($value->created_at)) }}</td>
                                        @if($value->promotion_price == null)
                                            <td style="color: red;">0</td>
                                        @else 
                                            <td>{{$value->promotion_price}}.-</td>
                                        @endif

                                        @if($value->status == null)
                                            <td style="color: green;">เปิด</td>
                                        @else
                                            @if($value->status == 'เปิด')
                                                <td style="color: green;">{{$value->status}}</td>
                                            @else 
                                                <td style="color:red;">{{$value->status}}</td>
                                            @endif
                                        @endif
                                        <td>       
                                            <a href="{{url('/admin/delete-product-price-detail')}}/{{$value->id}}">
                                                <i class="fa fa-trash" style="color:red;"></i>
                                            </a>        
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            {{$product_prices->links()}}
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection