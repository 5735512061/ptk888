@extends("/backend/layouts/template/template-store")

@section("content")
<div class="main-body">
    <div class="page-wrapper">
        <div class="page-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>ติดต่อสอบถาม</h5>
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
                            <form action="{{url('store/send-message')}}" enctype="multipart/form-data" method="post">@csrf
                                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                    @if(Session::has('alert-' . $msg))
                                        <p class="alertdesign alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                                    @endif
                                @endforeach
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">ผู้ติดต่อ</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="{{Auth::guard('store')->user()->name}}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">เบอร์โทรศัพท์</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="{{Auth::guard('store')->user()->phone}}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">หัวข้อเรื่อง</label>
                                    <div class="col-sm-10">
                                        @if ($errors->has('subject'))
                                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('subject') }})</span>
                                        @endif
                                        <input type="text" class="form-control" name="subject">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">ข้อความที่ต้องการติดต่อ</label>
                                    <div class="col-sm-10">
                                        @if ($errors->has('message'))
                                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('message') }})</span>
                                        @endif
                                        <textarea class="form-control" rows="5" placeholder="ข้อความที่ต้องการติดต่อ" name="message"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-4 offset-md-2">
                                        <input type="hidden" name="store_id" value="{{Auth::guard('store')->user()->id}}"> 
                                        <button type="submit" class="btn btn-mat waves-effect waves-light btn-primary">ส่งข้อความติดต่อ</button>
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