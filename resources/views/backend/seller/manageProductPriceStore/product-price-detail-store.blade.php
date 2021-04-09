@extends("/backend/layouts/template/template-seller")

@section("content")
<div class="main-body">
    <div class="page-wrapper">
        <div class="page-body">
            <div class="card">
                <div class="card-header">
                    <h5>ข้อมูลราคาสินค้า {{$film_type}}</h5>
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
                                @foreach ($film_price_stores as $film_price_store => $value)
                                    <tr>
                                        <th scope="row">{{$NUM_PAGE*($page-1) + $film_price_store+1}}</th>
                                        <td>{{$value->date}}</td>
                                        @if($value->price == null)
                                            <td style="color: red;">0</td>
                                        @else 
                                            <td>{{$value->price}}.-</td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                            {{$film_price_stores->links()}}
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection