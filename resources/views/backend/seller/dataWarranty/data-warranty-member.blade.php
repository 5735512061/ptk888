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
                                    <th>ชื่อ-นามสกุล</th>
                                    <th>เบอร์โทรศัพท์</th>
                                    <th>ยี่ห้อโทรศัพท์</th>
                                    <th>ยี่ห้อฟิล์ม</th>
                                    <th>หมายเลขซีเรียล</th>
                                    <th>วันที่สั่งซื้อ</th>
                                    <th>จุดที่ใช้บริการ</th>
                                    <th>สถานที่จุดบริการ</th>
                                    <th>สถานะ</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_warrantys as $data_warranty => $value)
                                    <tr>
                                        <th scope="row">{{$NUM_PAGE*($page-1) + $data_warranty+1}}</th>
                                        @php
                                            $name = DB::table('members')->where('id',$value->member_id)->value('name');
                                            $surname = DB::table('members')->where('id',$value->member_id)->value('surname');
                                            $phone = DB::table('members')->where('id',$value->member_id)->value('phone');
                                            $status = DB::table('warranty_confirms')->where('warranty_id',$value->id)->value('status');
                                        @endphp
                                        <td>{{$name}} {{$surname}}</td>
                                        <td>{{$phone}}</td>
                                        <td>{{$value->phone_model}}</td>
                                        <td>{{$value->film_model}}</td>
                                        <td>{{$value->serialnumber}}</td>
                                        <td>{{$value->date_order}}</td>
                                        <td>{{$value->service_point}}</td>
                                        <td>{{$value->address_service}}</td>
                                        @if($status == "เคลมแล้ว")
                                            <td style="color:green;">{{$status}}</td>
                                        @elseif($status == null)
                                            <td style="color:red;">ยังไม่เคลม</td>
                                        @endif
                                        <td>       
                                            <a href="{{url('/seller/edit-data-warranty')}}/{{$value->id}}">
                                                <i class="fa fa-pencil-square-o" style="color:blue;"></i>
                                            </a>        
                                            <a href="{{url('/seller/delete-data-warranty/')}}/{{$value->id}}" onclick="return confirm('Are you sure to delete ?')">
                                                <i class="fa fa-trash" style="color:red;"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            {{$data_warrantys->links()}}
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection