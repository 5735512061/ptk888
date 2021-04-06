@extends("/backend/layouts/template/template-store")

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
                                    <th>ประเภทฟิล์ม</th>
                                    <th style="text-align: center;">จำนวนแผ่นฟิล์ม</th>
                                    <th>ราคาต่อแผ่น</th>
                                    <th>สั่งซื้อสินค้า</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($stock_films as $stock_film => $value)
                                    <tr>
                                        <th scope="row">{{$NUM_PAGE*($page-1) + $stock_film+1}}</th>
                                        @php
                                            $film_type = DB::table('stock_films')->where('id',$value->film_id)->value('film_type');
                                            $amount = DB::table('stock_films')->where('id',$value->film_id)->value('amount');
                                        @endphp
                                        <td>{{$film_type}}</td>
                                        <td>
                                            <h6 style="text-align: center;">
                                                @if($amount == 0)
                                                    <div style="color: red;">สินค้าหมด</div> 
                                                @else
                                                    {{$amount}} แผ่น
                                                @endif
                                            </h6>
                                        </td>
                                        <td>{{$value->price}} บาท</td>
                                        <td>  
                                            @if($amount == 0)
                                                <div style="color: red;">สินค้าหมด</div> 
                                            @else
                                                <a type="button" data-toggle="modal" data-target="#ModalOrder{{$value->id}}" style="color:blue;">
                                                    กดสั่งซื้อ{{$film_type}}
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                    <!-- Modal -->
                                    <div class="modal fade" id="ModalOrder{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">สั่งซื้อ{{$film_type}}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{url('/store/add-to-cart')}}" enctype="multipart/form-data" method="post">@csrf
                                                    <div class="modal-body">
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label">จำนวนที่สั่งซื้อ</label>
                                                            <div class="col-sm-6">
                                                                <input type="text" name="qty" class="form-control">
                                                            </div>
                                                            <label class="col-sm-3 col-form-label">แผ่น</label>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <input type="hidden" name="product_id" value="{{$value->id}}">
                                                        <input type="hidden" name="store_id" value="{{Auth::guard('store')->user()->id}}">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                                                        <button type="submit" class="btn btn-primary">สั่งซื้อสินค้า</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
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