@extends("/backend/layouts/template/template-admin")

@section("content")
<div class="main-body">
    <div class="page-wrapper">
        <div class="page-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>แก้ไขข้อมูลสมาชิกร้านค้า</h5>
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
                            <form action="{{url('/admin/update-member-store')}}" enctype="multipart/form-data" method="post">@csrf
                                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                    @if(Session::has('alert-' . $msg))
                                        <p class="alertdesign alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                                    @endif
                                @endforeach
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">{{ __('รหัสสมาชิกร้านค้า') }}</label>
        
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="store_id" value="{{$store->store_id}}" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">{{ __('ชื่อร้านค้า') }}</label>
        
                                    <div class="col-sm-6">
                                        @if ($errors->has('name'))
                                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('name') }})</span>
                                        @endif
                                        <input type="text" class="form-control" name="name" value="{{$store->name}}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">{{ __('เบอร์โทรศัพท์') }}</label>
        
                                    <div class="col-sm-6">
                                        @if ($errors->has('phone'))
                                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('phone') }})</span>
                                        @endif
                                        <input type="text" class="phone_format form-control" name="phone" value="{{$store->phone}}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">{{ __('ที่อยู่ตัวแทนจำหน่าย') }}</label>
        
                                    <div class="col-sm-6">
                                        @if ($errors->has('address'))
                                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('address') }})</span>
                                        @endif
                                        <input type="text" class="form-control" name="address" value="{{$store->address}}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">{{ __('จังหวัดที่ตั้งของร้านค้า') }}</label>
        
                                    <div class="col-sm-6">
                                        @if ($errors->has('province'))
                                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('province') }})</span>
                                        @endif
                                        <input type="text" class="form-control" name="province" value="{{$store->province}}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">{{ __('บทบาท') }}</label>
        
                                    <div class="col-sm-6">
                                        <select name="role" class="form-control">
                                            <option value="{{$store->role}}">{{$store->role}}</option>
                                            <option value="สมาชิกร้านค้า">สมาชิกร้านค้า</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">{{ __('สถานะ') }}</label>
        
                                    <div class="col-sm-6">
                                        <select name="status" class="form-control">
                                            <option value="{{$store->status}}">{{$store->status}}</option>
                                            <option value="ใช้งานได้">ใช้งานได้</option>
                                            <option value="ปิดการใช้งาน">ปิดการใช้งาน</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">อัพโหลดรูปภาพโลโก้ร้านค้า (ถ้ามี)</label>
                                    <div class="col-sm-6">
                                        <input type="file" class="form-control" name="image_logo">
                                    </div>
                                </div>

                                <input type="hidden" name="id" value="{{$store->id}}">
                                
                                <div class="form-group row mb-0">
                                    <div class="col-md-4 offset-md-2">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('บันทึกข้อมูลสมาชิกร้านค้า') }}
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
                                            <a href="{{url('/admin/edit-image')}}/{{$value->id}}">
                                                <i class="fa fa-pencil-square-o" style="color:blue;"></i>
                                            </a>        
                                            <a href="{{url('/admin/delete-image/')}}/{{$value->id}}" onclick="return confirm('Are you sure to delete ?')">
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