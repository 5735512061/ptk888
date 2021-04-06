@extends("/backend/layouts/template/template-store")

@section("content")
<div class="main-body">
    <div class="page-wrapper">
        <div class="page-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>ประวัติการติดต่อสอบถาม</h5>
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
                        @foreach ($messages as $message => $value)
                            <div class="card-block">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">หัวข้อเรื่อง</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="{{$value->subject}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">ข้อความติดต่อ</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" rows="3">{{$value->message}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">ข้อความตอบกลับ</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" rows="3">{{$value->answer_message}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">สถานะ</label>
                                    <div class="col-sm-10">
                                        @if($value->answer_message == null)
                                            <p style="color:red; font-size:15px;">รอการตอบกลับ</p> 
                                        @else
                                            <p style="color:green; font-size:15px;">ตอบแล้ว</p>
                                        @endif 
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {{$messages->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection