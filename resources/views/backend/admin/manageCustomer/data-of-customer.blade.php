@extends("/backend/layouts/template/template-admin")

@section("content")
<div class="main-body">
    <div class="page-wrapper">
        <div class="page-body">
            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                @if(Session::has('alert-' . $msg))
                    <p class="alertdesign alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                @endif
            @endforeach 
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
                                            <th>วันที่สมัครสมาชิก</th>
                                            <th>ชื่อ-นามสกุล</th>
                                            <th>เบอร์โทรศัพท์</th>
                                            <th>ที่อยู่</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($customers as $customer => $value)
                                            <tr>
                                                <th scope="row">{{$NUM_PAGE*($page-1) + $customer+1}}</th>
                                                <td>{{$value->member_id}}</td>
                                                <td>{{$value->date}}</td>
                                                <td>{{$value->name}} {{$value->surname}}</td>
                                                <td>{{$value->phone}}</td>
                                                <td>
                                                    <a type="button" data-toggle="modal" data-target="#ModalAddress{{$value->id}}" style="color:blue;">
                                                        ดูที่อยู่
                                                    </a>
                                                </td>
                                                <td>       
                                                    <a href="{{url('/admin/edit-member-customer')}}/{{$value->id}}">
                                                        <i class="fa fa-pencil-square-o" style="color:blue;"></i>
                                                    </a>        
                                                    <a href="{{url('/admin/delete-member-customer/')}}/{{$value->id}}" onclick="return confirm('Are you sure to delete ?')">
                                                        <i class="fa fa-trash" style="color:red;"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <!-- Modal -->
                                            <div class="modal fade" id="ModalAddress{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">ที่อยู่ลูกค้า</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group row">
                                                                <div class="col-md-12">
                                                                    <textarea cols="50" rows="5" class="form-control">{{$value->address}} {{$value->district}} {{$value->amphoe}} {{$value->province}} {{$value->zipcode}}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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