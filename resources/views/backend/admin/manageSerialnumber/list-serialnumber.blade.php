@extends("/backend/layouts/template/template-admin")

@section("content")
<div class="main-body">
    <div class="page-wrapper">
        <div class="page-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>สร้างหมายเลขสินค้า</h5>
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
                            <form action="{{url('/admin/serialnumber')}}" enctype="multipart/form-data" method="post">@csrf
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">ยี่ห้อฟิล์ม</label>
                                    <div class="col-md-10">
                                        <select name="film_model" class="form-control">
                                            <option value="Madam Film">Madam Film</option>
                                            <option value="Dora Shield">Dora Shield</option>
                                            <option value="Raiguard Film">Raiguard Film</option>
                                        </select>
                                    </div>
                                </div>
                                @php
                                    $random = rand(1111111111111111,9999999999999999);  
                                    $random_format = wordwrap($random , 4 , ' ' , true );
                                    $id = $random_format;
                                    
                                    $serialnumber_id = DB::table('serialnumbers')->where('serialnumber',$id)->value('serialnumber');
                                        if($serialnumber_id == null) {
                                            $id_gen = $id;
                                        } else {
                                            $random = rand(1111111111111111,9999999999999999);  
                                            $random_format = wordwrap($random , 4 , ' ' , true );
                                            $id_gen = $random_format;
                                        }
                                @endphp
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <input type="hidden" class="form-control" name="serialnumber" value="{{$id_gen}}">
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-4 offset-md-2">
                                        <button type="submit" class="btn btn-mat waves-effect waves-light btn-primary">สร้างหมายเลขสินค้า</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5>หมายเลขสินค้า</h5>
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
                                    <th>ยี่ห้อฟิล์ม</th>
                                    <th>หมายเลขสินค้า</th>
                                    <th>สถานะ</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($serialnumbers as $serialnumber => $value)
                                    <tr>
                                        <th scope="row">{{$NUM_PAGE*($page-1) + $serialnumber+1}}</th>
                                        <td>{{$value->film_model}}</td>
                                        <td>{{$value->serialnumber}}</td>
                                        @if($value->status == 'ใช้งานแล้ว')
                                            <td style="color:green;">{{$value->status}}</td>
                                        @else 
                                            <td style="color:red;">{{$value->status}}</td>
                                        @endif
                                        <td>       
                                            <a href="{{url('/admin/edit-serialnumber')}}/{{$value->id}}">
                                                <i class="fa fa-pencil-square-o" style="color:blue;"></i>
                                            </a>        
                                            <a href="{{url('/admin/delete-serialnumber/')}}/{{$value->id}}" onclick="return confirm('Are you sure to delete ?')">
                                                <i class="fa fa-trash" style="color:red;"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            {{$serialnumbers->links()}}
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection