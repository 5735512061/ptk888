@extends("/backend/layouts/template/template-admin")

@section("content")
<div class="main-body">
    <div class="page-wrapper">
        <div class="page-body">
            <div class="card">
                <div class="card-header">
                    <h5>ข้อมูลการสั่งซื้อของลูกค้า</h5>
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
                                    <th>ยี่ห้อฟิล์ม</th>
                                    <th>หมายเลขซีเรียล 16 หลัก</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order => $value)
                                    <tr>
                                        <th scope="row">{{$NUM_PAGE*($page-1) + $order+1}}</th>
                                        @php
                                            $film_model = DB::table('serialnumbers')->where('id',$value->film_model_id)->value('film_model');
                                        @endphp
                                        <td>{{$film_model}}</td>
                                        <td>{{$value->serialnumber}}</td>
                                        <td>       
                                            <a href="{{url('/admin/delete-product-out/')}}/{{$value->id}}" onclick="return confirm('Are you sure to delete ?')">
                                                <i class="fa fa-trash" style="color:red;"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            {{$orders->links()}}
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection