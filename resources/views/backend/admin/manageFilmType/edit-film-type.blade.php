@extends("/backend/layouts/template/template-admin")

@section("content")
<div class="main-body">
    <div class="page-wrapper">
        <div class="page-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>แก้ไขประเภทฟิล์ม</h5>
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
                            <form action="{{url('/admin/update-film-type')}}" enctype="multipart/form-data" method="post">@csrf
                                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                    @if(Session::has('alert-' . $msg))
                                        <p class="alertdesign alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                                    @endif
                                @endforeach
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">ประเภทฟิล์ม</label>
                                    <div class="col-sm-10">
                                        @if ($errors->has('film_type'))
                                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('film_type') }})</span>
                                        @endif
                                        <input type="text" class="form-control" name="film_type" value="{{$film_type->film_type}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">ประเภทฟิล์มภาษาอังกฤษ</label>
                                    <div class="col-sm-10">
                                        @if ($errors->has('film_type_eng'))
                                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('film_type_eng') }})</span>
                                        @endif
                                        <input type="text" class="form-control" name="film_type_eng" value="{{$film_type->film_type_eng}}">
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-4 offset-md-2">
                                        <input type="hidden" name="id" value="{{$film_type->id}}">
                                        <button type="submit" class="btn btn-mat waves-effect waves-light btn-primary">อัพเดตประเภทฟิล์ม</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5>รายละเอียดประเภทฟิล์ม</h5>
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
                                    <th>ประเภทฟิล์ม (ภาษาอังกฤษ)</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($film_types as $film_type => $value)
                                    <tr>
                                        <th scope="row">{{$NUM_PAGE*($page-1) + $film_type+1}}</th>
                                        <td>{{$value->film_type}}</td>
                                        <td>{{$value->film_type_eng}}</td>
                                        <td>       
                                            <a href="{{url('/admin/edit-film-type')}}/{{$value->id}}">
                                                <i class="fa fa-pencil-square-o" style="color:blue;"></i>
                                            </a>        
                                            <a href="{{url('/admin/delete-film-type/')}}/{{$value->id}}" onclick="return confirm('Are you sure to delete ?')">
                                                <i class="fa fa-trash" style="color:red;"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            {{$film_types->links()}}
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection