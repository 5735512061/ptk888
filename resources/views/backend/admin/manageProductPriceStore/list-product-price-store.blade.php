@extends("/backend/layouts/template/template-admin")

@section("content")
<div class="main-body">
    <div class="page-wrapper">
        <div class="page-body">
            <div class="card">
                <div class="card-header">
                    <h5>จัดการราคาของร้านค้า สินค้าแบบแผ่น</h5> 
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
                                @foreach ($stock_films as $stock_film => $value)
                                    <tr>
                                        <th scope="row">{{$NUM_PAGE*($page-1) + $stock_film+1}}</th>
                                        @php 
                                            $price = number_format(DB::table('film_price_stores')->where('film_id',$value->id)->orderBy('id','desc')->value('price'));
                                            $status = DB::table('product_prices')->where('product_id',$value->id)->value('status');
                                        @endphp
                                        <td>{{$value->film_type}}</td>
                                        @if($price == null)
                                            <td style="color: red;">0</td>
                                        @else 
                                            <td>{{$price}}.-</td>
                                        @endif
                                        <td>       
                                            <a href="{{url('/admin/edit-product-price-store')}}/{{$value->id}}">
                                                <i class="fa fa-pencil-square-o" style="color:blue;"></i>
                                            </a> 
                                            <a href="{{url('/admin/product-price-detail-store')}}/{{$value->id}}">
                                                <i class="fa fa-folder" style="color:blue;"></i>
                                            </a>        
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            {{$stock_films->links()}}
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection