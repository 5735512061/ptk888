@extends("/frontend/layouts/template/template")

@section('content')
<!-- Login Start -->
<div class="login">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">    
                <div class="register-form">
                    <h3>เคลมสินค้า</h3><hr>
                    <form action="{{url('member/claim-product')}}" enctype="multipart/form-data" method="post">@csrf
                        @csrf
                        <div class="flash-message">
                            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                @if(Session::has('alert-' . $msg))
                                    <p class="alertdesign alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                                @endif
                            @endforeach
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('สาเหตุการเคลมสินค้า') }}</label>

                            <div class="col-md-6">
                                @if ($errors->has('reason'))
                                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('reason') }})</span>
                                @endif
                                <textarea type="text" class="form-control" name="reason"></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('รูปสินค้าที่ต้องการเคลม') }}</label>
                            <div class="col-md-6">
                                @if ($errors->has('image'))
                                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('image') }})</span>
                                @endif
                                <div class="custom-file">
                                    <input type="file" class="slip custom-file-input" id="inputGroupFile04" name="image">
                                    <label class="custom-file-label m-text14" for="inputGroupFile04" style="font-size: 14px;">อัพโหลดรูปสินค้าที่ต้องการเคลม</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('ที่อยู่') }}</label>

                            <div class="col-md-6">
                                @if ($errors->has('address'))
                                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('address') }})</span>
                                @endif
                                <textarea type="text" class="form-control" name="address"></textarea>
                            </div>
                        </div>

                        <input type="hidden" name="date" id="datepicker">
                        <input type="hidden" name="member_id" value="{{auth('member')->user()->id}}">
                        <input type="hidden" name="warranty_id" value="{{$claim_product->id}}">

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn">
                                    {{ __('เคลมสินค้า') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="register-form">
                    <h4>เงื่อนไขการเคลมสินค้า</h4><hr>
                    <p><i class="fa fa-caret-right"></i> ระบุสาเหตุการเคลมสินค้า</p> 
                    <p><i class="fa fa-caret-right"></i> รอยืนยันการเคลมสินค้าจากระบบ</p> 
                    <p><i class="fa fa-caret-right"></i> ถ่ายรูปยืนยันสินค้าที่ต้องการเคลม และส่งสินค้าคืนทางบริษัทฯ</p> 
                    <p><i class="fa fa-caret-right"></i> ทางบริษัทฯ จัดส่งสินค้าใหม่ให้กับคุณลูกค้า</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Login End -->
<script type="text/javascript" src="{{asset('https://code.jquery.com/jquery-3.2.1.min.js')}}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.20/js/uikit.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
<script>
    // date
    $('#datepicker').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true,
        todayHighlight: true,
    });
    $('#datepicker').datepicker("setDate", new Date());
</script>
@endsection
