@extends("/backend/layouts/template/template-seller")

@section("content")
<div class="main-body">
    <div class="page-wrapper">
        <div class="page-body">
            <div class="card">
                <div class="card-header">
                    <h5>ข้อมูลราคาสินค้า {{$film_brand}} {{$film_type}}</h5>
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
                                    <th>ราคาล่าสุด</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product_store_film_brand_prices as $product_store_film_brand_price => $value)
                                    <tr>
                                        <th scope="row">{{$NUM_PAGE*($page-1) + $product_store_film_brand_price+1}}</th>
                                        <td>{{ date('Y-m-d', strtotime($value->created_at)) }}</td>
                                        @if($value->price == null)
                                            <td style="color: red;">0</td>
                                        @else 
                                            <td>{{$value->price}}.-</td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                            {{$product_store_film_brand_prices->links()}}
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection