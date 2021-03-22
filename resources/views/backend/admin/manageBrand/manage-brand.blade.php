@extends("/backend/layouts/template/template-admin")

@section("content")
<div class="main-body">
    <div class="page-wrapper">
        <div class="page-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>อัพโหลดยี่ห้อโทรศัพท์</h5>
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
                            <form action="{{url('/admin/upload-brand')}}" enctype="multipart/form-data" method="post">@csrf
                                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                    @if(Session::has('alert-' . $msg))
                                        <p class="alertdesign alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                                    @endif
                                @endforeach
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">ยี่ห้อโทรศัพท์</label>
                                    <div class="col-sm-10">
                                        @if ($errors->has('brand'))
                                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('brand') }})</span>
                                        @endif
                                        <input type="text" class="form-control" placeholder="กรุณากรอกยี่ห้อโทรศัพท์" name="brand">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">ยี่ห้อโทรศัพท์ภาษาอังกฤษ</label>
                                    <div class="col-sm-10">
                                        @if ($errors->has('brand_eng'))
                                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('brand_eng') }})</span>
                                        @endif
                                        <input type="text" class="form-control" placeholder="กรุณากรอกยี่ห้อโทรศัพท์เป็นภาษาอังกฤษ เท่านั้น" name="brand_eng">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">อัพโหลดรูปภาพโลโก้ยี่ห้อ</label>
                                    <div class="col-sm-10">
                                        @if ($errors->has('image'))
                                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('image') }})</span>
                                        @endif
                                        <input type="file" class="form-control" name="image">
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-4 offset-md-2">
                                        <button type="submit" class="btn btn-mat waves-effect waves-light btn-primary">อัพโหลดยี่ห้อโทรศัพท์</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5>รายละเอียดยี่ห้อโทรศัพท์</h5>
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
                                    <th>ยี่ห้อโทรศัพท์</th>
                                    <th>ยี่ห้อโทรศัพท์ (ภาษาอังกฤษ)</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($brands as $brand => $value)
                                    <tr>
                                        <th scope="row">{{$NUM_PAGE*($page-1) + $brand+1}}</th>
                                        <td><img src="{{url('/image_upload/image_brand')}}/{{$value->image}}" class="img-responsive" height="50px;"></td>
                                        <td>{{$value->brand}}</td>
                                        <td>{{$value->brand_eng}}</td>
                                        <td>       
                                            <a href="{{url('/admin/edit-brand')}}/{{$value->id}}">
                                                <i class="fa fa-pencil-square-o" style="color:blue;"></i>
                                            </a>        
                                            <a href="{{url('/admin/delete-brand/')}}/{{$value->id}}" onclick="return confirm('Are you sure to delete ?')">
                                                <i class="fa fa-trash" style="color:red;"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            {{$brands->links()}}
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection