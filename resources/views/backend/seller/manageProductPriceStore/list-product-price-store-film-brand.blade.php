@extends("/backend/layouts/template/template-seller")

@section("content")
<div class="main-body">
    <div class="page-wrapper">
        <div class="page-body">
            <div class="card">
                <div class="card-header">
                    <h5>จัดการราคาสินค้าพร้อมแพ็คเกจของร้านค้า</h5>
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
                                    <th>ชื่อสินค้า</th>
                                    <th>ราคาล่าสุด</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product_store_film_brands as $product_store_film_brand => $value)
                                    <tr>
                                        <th scope="row">{{$NUM_PAGE*($page-1) + $product_store_film_brand+1}}</th>
                                        @php
                                            $price = number_format(DB::table('product_store_film_brand_prices')->where('product_id',$value->id)->orderBy('id','desc')->value('price'));
                                            $film_type = DB::table('film_types')->where('id',$value->film_type_id)->value('film_type');
                                        @endphp
                                        <td>{{$value->film_brand}} {{$film_type}}</td>
                                        @if($price == null)
                                            <td style="color: red;">0</td>
                                        @else 
                                            <td>{{$price}}.-</td>
                                        @endif
                                        <td>       
                                            <a href="{{url('/seller/edit-product-price-store-film-brand')}}/{{$value->id}}">
                                                <i class="fa fa-pencil-square-o" style="color:blue;"></i>
                                            </a> 
                                            <a href="{{url('/seller/product-price-detail-store-film-brand')}}/{{$value->id}}">
                                                <i class="fa fa-folder" style="color:blue;"></i>
                                            </a>        
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            {{$product_store_film_brands->links()}}
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection