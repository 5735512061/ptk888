@extends("/backend/layouts/template/template-admin")

@section("content")
<div class="main-body">
    <div class="page-wrapper">
        <div class="page-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>อัพโหลดโปรโมชั่น</h5>
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
                            <form action="{{url('/admin/upload-promotion')}}" enctype="multipart/form-data" method="post">@csrf
                                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                    @if(Session::has('alert-' . $msg))
                                        <p class="alertdesign alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                                    @endif
                                @endforeach
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">อัพโหลดรูปภาพโปรโมชั่น</label>
                                    <div class="col-sm-10">
                                        @if ($errors->has('image'))
                                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('image') }})</span>
                                        @endif
                                        <input type="file" class="form-control" name="image">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">หัวข้อคำอธิบาย</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" placeholder="หัวข้อคำอธิบาย (ถ้ามี)" name="heading_detail">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">รายละเอียดเพิ่มเติม</label>
                                    <div class="col-sm-10">
                                        <textarea name="detail" rows="5" cols="5" class="form-control"
                                        placeholder="รายละเอียดเพิ่มเติม (ถ้ามี)"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">สถานะ</label>
                                    <div class="col-sm-10">
                                        <select name="image_type" class="form-control">
                                            <option value="เปิดโปรโมชั่น">เปิดโปรโมชั่น</option>
                                            <option value="ปิดโปรโมชั่น">ปิดโปรโมชั่น</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-4 offset-md-2">
                                        <button type="submit" class="btn btn-mat waves-effect waves-light btn-primary">อัพโหลดโปรโมฃั่น</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5>รายละเอียดโปรโมชั่น</h5>
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
                                    <th>รูปภาพ</th>
                                    <th>หัวข้อคำอธิบาย</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($promotions as $promotion => $value)
                                    <tr>
                                        <th scope="row">{{$NUM_PAGE*($page-1) + $promotion+1}}</th>
                                        <td><img src="{{url('/image_upload/image_promotion')}}/{{$value->image}}" class="img-responsive" height="50px;"></td>
                                        <td>{{$value->heading_detail}}</td>
                                        <td>       
                                            <a href="{{url('/admin/edit-image-website')}}/{{$value->id}}">
                                                <i class="fa fa-pencil-square-o" style="color:blue;"></i>
                                            </a>        
                                            <a href="{{url('/admin/delete-image-website/')}}/{{$value->id}}" onclick="return confirm('Are you sure to delete ?')">
                                                <i class="fa fa-trash" style="color:red;"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            {{$promotions->links()}}
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection