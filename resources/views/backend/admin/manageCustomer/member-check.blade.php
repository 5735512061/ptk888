@extends("/backend/layouts/template/template-admin")

@section("content")
<div class="main-body">
    <div class="page-wrapper">
        <div class="page-body">
            <div class="row">
                <div class="col-xl-12 col-md-12">
                    <div class="card table-card">
                        <div class="card-header">
                            <h5>ข้อมูลลูกค้า</h5>
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
                        <div class="card-block">
                            <div class="table-responsive"><br>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>รหัสสมาชิก</th>
                                            <th>ชื่อ-นามสกุล</th>
                                            <th>เบอร์โทรศัพท์</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($customers as $customer => $value)
                                            <tr>
                                                <th scope="row">{{$NUM_PAGE*($page-1) + $customer+1}}</th>
                                                <td>
                                                    @if($value->member_id == NULL) 
                                                        <a href="{{url('/admin/manage-member-customer/')}}/{{$value->id}}" style="color: red;">ตรวจสอบการสมัครสมาชิก</a>
                                                    @else 
                                                        {{$value->member_id}}
                                                    @endif
                                                </td>
                                                <td>{{$value->name}} {{$value->surname}}</td>
                                                <td>{{$value->phone}}</td>
                                                <td>       
                                                    <a href="{{url('/admin/edit-image')}}/{{$value->id}}">
                                                        <i class="fa fa-pencil-square-o" style="color:blue;"></i>
                                                    </a>        
                                                    <a href="{{url('/admin/delete-image/')}}/{{$value->id}}" onclick="return confirm('Are you sure to delete ?')">
                                                        <i class="fa fa-trash" style="color:red;"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="text-right m-r-20">
                                    {{$customers->links()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection