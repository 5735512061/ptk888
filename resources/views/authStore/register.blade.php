@extends("/backend/layouts/template/template-admin")

@section("content")
<div class="main-body">
    <div class="page-wrapper">
        <div class="page-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>ลงทะเบียนสมาชิกร้านค้า</h5>
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
                            <form action="{{url('/admin/register-store')}}" enctype="multipart/form-data" method="post">@csrf
                                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                    @if(Session::has('alert-' . $msg))
                                        <p class="alertdesign alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                                    @endif
                                @endforeach
                                @php
                                    $random = rand(111111,999999);  
                                    $random_format = wordwrap($random , 4 , '-' , true );
                                    $id = 'PTK-S-'.$random_format;
                                    
                                    $store_id = DB::table('stores')->where('store_id',$id)->value('store_id');
                                        if($store_id == null) {
                                            $id_gen = $id;
                                        } else {
                                            $random = rand(111111,999999);  
                                            $random_format = wordwrap($random , 4 , '-' , true );
                                            $id_gen = 'PTK-S-'.$random_format;
                                        }
                                @endphp
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">{{ __('รหัสสมาชิกร้านค้า') }}</label>
        
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="store_id" value="{{$id_gen}}" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">{{ __('ชื่อร้านค้า') }}</label>
        
                                    <div class="col-sm-6">
                                        @if ($errors->has('name'))
                                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('name') }})</span>
                                        @endif
                                        <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">{{ __('เบอร์โทรศัพท์') }}</label>
        
                                    <div class="col-sm-6">
                                        <input type="text" class="phone_format form-control" name="phone" value="{{ old('phone') }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">{{ __('ที่อยู่ตัวแทนจำหน่าย') }}</label>
        
                                    <div class="col-sm-6">
                                        @if ($errors->has('address'))
                                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('address') }})</span>
                                        @endif
                                        <input type="text" class="form-control" name="address" value="{{ old('address') }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">{{ __('บทบาท') }}</label>
        
                                    <div class="col-sm-6">
                                        <select name="role" class="form-control">
                                            <option value="สมาชิกร้านค้า">สมาชิกร้านค้า</option>
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
                                    <label class="col-sm-2 col-form-label">อัพโหลดรูปภาพโลโก้ร้านค้า (ถ้ามี)</label>
                                    <div class="col-sm-6">
                                        <input type="file" class="form-control" name="image_logo">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-sm-2 col-form-label">{{ __('รหัสผ่าน') }}</label>
        
                                    <div class="col-sm-6">
                                        @if ($errors->has('password'))
                                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('password') }})</span>
                                        @endif
                                        <input id="password" type="password" class="form-control" name="password">
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
                                            {{ __('ลงทะเบียนสมาชิกร้านค้า') }}
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
                    <h5>ข้อมูลสมาชิกร้านค้า</h5>
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
                                    <th>รหัสสมาชิก</th>
                                    <th>ชื่อร้านค้า</th>
                                    <th>เบอร์โทรศัพท์</th>
                                    <th>บทบาท</th>
                                    <th>สถานะ</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($members as $member => $value)
                                    <tr>
                                        <th scope="row">{{$NUM_PAGE*($page-1) + $member+1}}</th>
                                        <td>{{$value->store_id}}</td>
                                        <td>{{$value->name}}</td>
                                        <td>{{$value->phone}}</td>
                                        <td>{{$value->role}}</td>
                                        <td>{{$value->status}}</td>
                                        <td>       
                                            <a href="{{url('/admin/edit-member-store')}}/{{$value->id}}">
                                                <i class="fa fa-pencil-square-o" style="color:blue;"></i>
                                            </a>        
                                            <a href="{{url('/admin/delete-member-store/')}}/{{$value->id}}" onclick="return confirm('Are you sure to delete ?')">
                                                <i class="fa fa-trash" style="color:red;"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="text-right m-r-20">
                            {{$members->links()}}
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