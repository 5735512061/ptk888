@extends("/backend/layouts/template/template-admin")

@section("content")
<div class="main-body">
    <div class="page-wrapper">
        <div class="page-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>อัพโหลดรูปภาพหน้าเว็บไซต์</h5>
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
                            <form action="{{url('/admin/upload-image-website')}}" enctype="multipart/form-data" method="post">@csrf
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">ประเภทรูปภาพ</label>
                                    <div class="col-sm-10">
                                        <select name="image_type" class="form-control">
                                            <option value="รูปภาพโลโก้">รูปภาพโลโก้</option>
                                            <option value="รูปภาพสไลด์หลัก หน้าแรก">รูปภาพสไลด์หลัก หน้าแรก</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">อัพโหลดรูปภาพ</label>
                                    <div class="col-sm-10">
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
                                <div class="form-group row mb-0">
                                    <div class="col-md-4 offset-md-2">
                                        <button type="submit" class="btn btn-mat waves-effect waves-light btn-primary">อัพโหลดรูปภาพ</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5>รายละเอียดรูปภาพหน้าเว็บไซต์</h5>
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
                                    <th>ประเภทรูปภาพ</th>
                                    <th>หัวข้อคำอธิบาย</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($productRecommends as $productRecommend => $value)
                                    <tr>
                                        <th scope="row">{{$NUM_PAGE*($page-1) + $productRecommend+1}}</th>
                                        <td><img src="{{url('/image_upload/image_website')}}/{{$value->image}}" class="img-responsive" height="50px;"></td>
                                        <td>{{$value->image_type}}</td>
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
                            {{$productRecommends->links()}}
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection