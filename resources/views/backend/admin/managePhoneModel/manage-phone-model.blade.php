@extends("/backend/layouts/template/template-admin")

@section("content")
<div class="main-body">
    <div class="page-wrapper">
        <div class="page-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card table-card">
                        <div class="card-header">
                            <h5>ค้นหารุ่นโทรศัพท์</h5>
                        </div><br>
                        <div class="card-block">
                            <form action="{{url('/admin/search-phone-model')}}" enctype="multipart/form-data" method="post">@csrf
                                <div class="row" style="margin-left: 5px; margin-right: 5px;">
                                    <div class="col-md-3">
                                        <input type="text" name="model" class="form-control" placeholder="ค้นหารุ่นโทรศัพท์"><br>
                                        <button type="submit" class="btn btn-mat waves-effect waves-light btn-primary">ค้นหารุ่นโทรศัพท์</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h5>อัพโหลดรุ่นโทรศัพท์</h5>
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
                            <form action="{{url('/admin/upload-phone-model')}}" enctype="multipart/form-data" method="post">@csrf
                                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                    @if(Session::has('alert-' . $msg))
                                        <p class="alertdesign alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                                    @endif
                                @endforeach
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">ยี่ห้อโทรศัพท์</label>
                                    <div class="col-sm-10">
                                        <select name="brand_id" class="form-control">
                                            @foreach ($brands as $brand => $value)
                                                <option value="{{$value->id}}">{{$value->brand}}</option>
                                            @endforeach
                                        </select>
                                    </div> 
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">รุ่นโทรศัพท์</label>
                                    <div class="col-sm-10">
                                        @if ($errors->has('model'))
                                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('model') }})</span>
                                        @endif
                                        <input type="text" class="form-control" placeholder="กรุณากรอกรุ่นโทรศัพท์" name="model">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">รุ่นโทรศัพท์ภาษาอังกฤษ</label>
                                    <div class="col-sm-10">
                                        @if ($errors->has('model_eng'))
                                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('model_eng') }})</span>
                                        @endif
                                        <input type="text" class="form-control" placeholder="กรุณากรอกรุ่นโทรศัพท์เป็นภาษาอังกฤษ เท่านั้น" name="model_eng">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">สถานะ</label>
                                    <div class="col-sm-10">
                                        <select name="status" class="form-control">
                                            <option value="เปิด">เปิด</option>
                                            <option value="ปิด">ปิด</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-4 offset-md-2">
                                        <button type="submit" class="btn btn-mat waves-effect waves-light btn-primary">อัพโหลดรุ่นโทรศัพท์</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5>รายละเอียดรุ่นโทรศัพท์</h5>
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
                                    <th>ยี่ห้อโทรศัพท์</th>
                                    <th>รุ่นโทรศัพท์</th>
                                    <th>รุ่นโทรศัพท์ (ภาษาอังกฤษ)</th>
                                    <th>สถานะ</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($phoneModels as $phoneModel => $value)
                                    <tr>
                                        <th scope="row">{{$NUM_PAGE*($page-1) + $phoneModel+1}}</th>
                                        @php
                                            $brand = DB::table('brands')->where('id',$value->brand_id)->value('brand');
                                        @endphp
                                        <td>{{$brand}}</td>
                                        <td>{{$value->model}}</td>
                                        <td>{{$value->model_eng}}</td>
                                        <td>{{$value->status}}</td>
                                        <td>       
                                            <a href="{{url('/admin/edit-phone-model')}}/{{$value->id}}">
                                                <i class="fa fa-pencil-square-o" style="color:blue;"></i>
                                            </a>        
                                            <a href="{{url('/admin/delete-phone-model/')}}/{{$value->id}}" onclick="return confirm('Are you sure to delete ?')">
                                                <i class="fa fa-trash" style="color:red;"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            {{$phoneModels->links()}}
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection