@extends("/backend/layouts/template/template-admin")

@section("content")
<div class="main-body">
    <div class="page-wrapper">
        <div class="page-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>แก้ไขข้อมูลสมาชิก</h5>
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
                            <form action="{{url('admin/update-member-customer')}}" enctype="multipart/form-data" method="post">@csrf 
                                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                    @if(Session::has('alert-' . $msg))
                                        <p class="alertdesign alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                                    @endif
                                @endforeach 
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label">{{ __('รหัสสมาชิก') }}</label>
        
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="member_id" value="{{$member->member_id}}" readonly>
                                    </div>
                                </div>
        
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label">{{ __('ชื่อ') }}</label>
        
                                    <div class="col-md-6">
                                        @if ($errors->has('name'))
                                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('name') }})</span>
                                        @endif
                                        <input type="text" class="form-control" name="name" value="{{$member->name}}">
                                    </div>
                                </div>
        
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label">{{ __('นามสกุล') }}</label>
        
                                    <div class="col-md-6">
                                        @if ($errors->has('surname'))
                                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('surname') }})</span>
                                        @endif
                                        <input type="text" class="form-control" name="surname" value="{{$member->surname}}">
                                    </div>
                                </div>
        
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label">{{ __('เบอร์โทรศัพท์') }}</label>
        
                                    <div class="col-md-6">
                                        @if ($errors->has('phone'))
                                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('phone') }})</span>
                                        @endif
                                        <input type="text" class="form-control" name="phone" value="{{$member->phone}}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label">{{ __('ที่อยู่') }}</label>
                                    <div class="col-md-6">
                                        @if ($errors->has('address'))
                                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('address') }})</span>
                                        @endif
                                        <input class="form-control" type="text" value="{{$member->address}}" name="address">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label">{{ __('ตำบล') }}</label>
                                    <div class="col-md-6">
                                        @if ($errors->has('district'))
                                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('district') }})</span>
                                        @endif
                                        <input class="form-control" type="text" value="{{$member->district}}" name="district">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label">{{ __('อำเภอ') }}</label>
                                    <div class="col-md-6">
                                        @if ($errors->has('amphoe'))
                                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('amphoe') }})</span>
                                        @endif
                                        <input class="form-control" type="text" value="{{$member->amphoe}}" name="amphoe">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label">{{ __('จังหวัด') }}</label>
                                    <div class="col-md-6">
                                        @if ($errors->has('province'))
                                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('province') }})</span>
                                        @endif
                                        <input class="form-control" type="text" value="{{$member->province}}" name="province">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label">{{ __('รหัสไปรษณีย์') }}</label>
                                    <div class="col-md-6">
                                        @if ($errors->has('zipcode'))
                                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('zipcode') }})</span>
                                        @endif
                                        <input class="form-control" type="text" value="{{$member->zipcode}}" name="zipcode">
                                    </div>
                                </div>

                                <input type="hidden" value="{{$member->id}}" name="id">
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-2">
                                        <button type="submit" class="btn">
                                            {{ __('บันทึกข้อมูลสมาชิก') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection