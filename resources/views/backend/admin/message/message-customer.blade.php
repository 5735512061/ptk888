@extends("/backend/layouts/template/template-admin")

@section("content")
<div class="main-body">
    <div class="page-wrapper">
        <div class="page-body">
            <div class="card">
                <div class="card-header">
                    <h5>รายละเอียดยี่ห้อผลิตภัณฑ์</h5>
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
                                    <th>ชื่อลูกค้า</th>
                                    <th>เบอร์โทรศัพท์</th>
                                    <th>หัวข้อเรื่อง</th>
                                    <th>ข้อความ</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($messages as $message => $value)
                                    <tr>
                                        <th scope="row">{{$NUM_PAGE*($page-1) + $message+1}}</th>
                                        <td>{{$value->name}}</td>
                                        <td>{{$value->phone}}</td>
                                        <td>{{$value->subject}}</td>
                                        <td>{{$value->message}}</td>
                                        <td>         
                                            <a href="{{url('/admin/delete-message-customer')}}/{{$value->id}}" onclick="return confirm('Are you sure to delete ?')">
                                                <i class="fa fa-trash" style="color:red;"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            {{$messages->links()}}
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection