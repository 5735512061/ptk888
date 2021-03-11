@extends("/backend/layouts/template/template-admin")

@section("content")
<div class="main-body">
    <div class="page-wrapper">
        <div class="page-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>แก้ไขข้อมูลและคุณสมบัติสินค้า</h5>
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
                            <form action="{{url('/admin/update-film-information')}}" enctype="multipart/form-data" method="post">@csrf
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">ประเภทฟิล์ม</label>
                                    <div class="col-sm-10">
                                        <select name="film_type_id" class="form-control">
                                            @php
                                                $film_type = DB::table('film_types')->where('id',$product_film_information->film_type_id)->value('film_type');
                                                $film_type_id = DB::table('film_types')->where('id',$product_film_information->film_type_id)->value('id');
                                            @endphp
                                            <option value="{{$film_type_id}}">{{$film_type}}</option>
                                            @foreach ($film_types as $film_type => $value)
                                                <option value="{{$value->id}}">{{$value->film_type}}</option>
                                            @endforeach
                                        </select>
                                    </div> 
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">ประเภทของข้อมูลสินค้า</label>
                                    <div class="col-sm-10">
                                        <select name="type_information" class="form-control">
                                            <option value="{{$product_film_information->type_information}}">{{$product_film_information->type_information}}</option>
                                            <option value="ข้อมูลและคุณสมบัติสินค้า">ข้อมูลและคุณสมบัติสินค้า</option>
                                            <option value="จุดเด่นของสินค้า">จุดเด่นของสินค้า</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">รายละเอียด</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" placeholder="กรุณากรอกรายละเอียด" name="film_information" value="{{$product_film_information->film_information}}">
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-4 offset-md-2">
                                        <input type="hidden" name="id" value="{{$product_film_information->id}}">
                                        <button type="submit" class="btn btn-mat waves-effect waves-light btn-primary">อัพเดตข้อมูลและคุณสมบัติสินค้า</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5>ข้อมูลและคุณสมบัติสินค้า</h5>
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
                                    <th>ประเภทของข้อมูล</th>
                                    <th>รายละเอียด</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product_film_informations as $product_film_information => $value)
                                    <tr>
                                        <th scope="row">{{$NUM_PAGE*($page-1) + $product_film_information+1}}</th>
                                        @php
                                            $film_type = DB::table('film_types')->where('id',$value->film_type_id)->value('film_type');
                                        @endphp
                                        <td>{{$film_type}}</td>
                                        <td>{{$value->type_information}}</td>
                                        <td>{{$value->film_information}}</td>
                                        <td>       
                                            <a href="{{url('/admin/edit-film-information')}}/{{$value->id}}">
                                                <i class="fa fa-pencil-square-o" style="color:blue;"></i>
                                            </a>        
                                            <a href="{{url('/admin/delete-film-information/')}}/{{$value->id}}" onclick="return confirm('Are you sure to delete ?')">
                                                <i class="fa fa-trash" style="color:red;"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            {{$product_film_informations->links()}}
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection