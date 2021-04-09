@extends("/backend/layouts/template/template-admin")

@section("content")
<div class="main-body">
    <div class="page-wrapper">
        <div class="page-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card table-card">
                        <div class="card-header">
                            <h5>ค้นหาข้อมูลพนักงานขาย</h5>
                        </div><br>
                        <div class="card-block">
                            <form action="{{url('/admin/search-seller')}}" enctype="multipart/form-data" method="post">@csrf
                                <div class="row" style="margin-left: 5px;">
                                    <div class="col-md-3">
                                        <input type="text" name="seller_id" class="form-control" placeholder="ค้นหารหัสพนักงาน"><br>
                                        <button type="submit" class="btn btn-mat waves-effect waves-light btn-primary">ค้นหารหัสพนักงาน</button>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="phone" class="form-control" placeholder="ค้นหาเบอร์โทรศัพท์"><br>
                                        <button type="submit" class="btn btn-mat waves-effect waves-light btn-primary">ค้นหาเบอร์โทรศัพท์</button>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="name" class="form-control" placeholder="ค้นหาชื่อพนักงาน"><br>
                                        <button type="submit" class="btn btn-mat waves-effect waves-light btn-primary">ค้นหาชื่อพนักงาน</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h5>ลงทะเบียนพนักงานขาย</h5>
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
                            <form action="{{url('/admin/register-seller')}}" enctype="multipart/form-data" method="post">@csrf
                                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                    @if(Session::has('alert-' . $msg))
                                        <p class="alertdesign alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                                    @endif
                                @endforeach
                                @php
                                    $random = rand(111111,999999);  
                                    $random_format = wordwrap($random , 4 , '-' , true );
                                    $id = 'PTK-L-'.$random_format;
                                    
                                    $seller_id = DB::table('sellers')->where('seller_id',$id)->value('seller_id');
                                        if($seller_id == null) {
                                            $id_gen = $id;
                                        } else {
                                            $random = rand(111111,999999);  
                                            $random_format = wordwrap($random , 4 , '-' , true );
                                            $id_gen = 'PTK-L-'.$random_format;
                                        }
                                @endphp
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">{{ __('รหัสพนักงานขาย') }}</label>
        
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control{{ $errors->has('seller_id') ? ' is-invalid' : '' }}" name="seller_id" value="{{$id_gen}}" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">{{ __('ชื่อ') }}</label>
        
                                    <div class="col-sm-6">
                                        @if ($errors->has('name'))
                                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('name') }})</span>
                                        @endif
                                        <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">{{ __('นามสกุล') }}</label>
        
                                    <div class="col-sm-6">
                                        @if ($errors->has('surname'))
                                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('surname') }})</span>
                                        @endif
                                        <input type="text" class="form-control" name="surname" value="{{ old('surname') }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">{{ __('เบอร์โทรศัพท์') }}</label>
        
                                    <div class="col-sm-6">
                                        @if ($errors->has('phone'))
                                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('phone') }})</span>
                                        @endif
                                        <input type="text" class="phone_format form-control" name="phone" value="{{ old('phone') }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">{{ __('บทบาท') }}</label>
        
                                    <div class="col-sm-6">
                                        <select name="role" class="form-control">
                                            <option value="พนักงานขาย">พนักงานขาย</option>
                                        </select>
        
                                        @if ($errors->has('role'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('role') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">{{ __('สถานะ') }}</label>
        
                                    <div class="col-sm-6">
                                        <select name="status" class="form-control">
                                            <option value="ใช้งานได้">ใช้งานได้</option>
                                            <option value="ปิดการใช้งาน">ปิดการใช้งาน</option>
                                        </select>
        
                                        @if ($errors->has('status'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('status') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-sm-2 col-form-label">{{ __('รหัสผ่าน') }}</label>
        
                                    <div class="col-sm-6">
                                        @if ($errors->has('password'))
                                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('password') }})</span>
                                        @endif
                                        <input id="password" type="password" class="form-control" name="password" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password-confirm" class="col-sm-2 col-form-label">{{ __('ยืนยันรหัสผ่าน') }}</label>
        
                                    <div class="col-sm-6">
                                        @if ($errors->has('password_confirmation'))
                                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('password_confirmation') }})</span>
                                        @endif
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                                    </div>
                                </div>
                                <input type="hidden" name="admin_id" value="{{Auth::guard('admin')->id()}}">
                                <div class="form-group row mb-0">
                                    <div class="col-md-4 offset-md-2">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('ลงทะเบียนพนักงานขาย') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5>ข้อมูลพนักงานขาย</h5>
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
                                    <th>รหัสพนักงาน</th>
                                    <th>ชื่อ นามสกุล</th>
                                    <th>เบอร์โทรศัพท์</th>
                                    <th>บทบาท</th>
                                    <th>สถานะ</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sellers as $seller => $value)
                                    <tr>
                                        <th scope="row">{{$NUM_PAGE*($page-1) + $seller+1}}</th>
                                        <td>{{$value->seller_id}}</td>
                                        <td>{{$value->name}} {{$value->surname}}</td>
                                        <td>{{$value->phone}}</td>
                                        <td>{{$value->role}}</td>
                                        <td>{{$value->status}}</td>
                                        <td>       
                                            <a href="{{url('/admin/edit-seller')}}/{{$value->id}}">
                                                <i class="fa fa-pencil-square-o" style="color:blue;"></i>
                                            </a>        
                                            <a href="{{url('/admin/delete-seller/')}}/{{$value->id}}" onclick="return confirm('Are you sure to delete ?')">
                                                <i class="fa fa-trash" style="color:red;"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="text-right m-r-20">
                            {{$sellers->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{asset('https://code.jquery.com/jquery-3.2.1.min.js')}}"></script>
<script>
    // number phone
    function phoneFormatter() {
         $('input.phone_format').on('input', function() {
             var number = $(this).val().replace(/[^\d]/g, '')
                 if (number.length >= 5 && number.length < 10) { number = number.replace(/(\d{3})(\d{2})/, "$1-$2"); } else if (number.length >= 10) {
                     number = number.replace(/(\d{3})(\d{3})(\d{3})/, "$1-$2-$3"); 
                 }
             $(this).val(number)
             $('input.phone_format').attr({ maxLength : 12 });    
         });
     };
     $(phoneFormatter);
 </script>
@endsection