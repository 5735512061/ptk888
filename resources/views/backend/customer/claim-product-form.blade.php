@extends("/frontend/layouts/template/template")

@section('content')
<!-- Login Start -->
<div class="login">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">    
                <div class="register-form">
                    <h3>@lang('claimProduct.claimProduct')</h3><hr>
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
                            <label class="col-md-4 col-form-label text-md-right">@lang('claimProduct.reasonsToClaim')</label>

                            <div class="col-md-6">
                                @if ($errors->has('reason'))
                                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('reason') }})</span>
                                @endif
                                <textarea type="text" class="form-control" name="reason"></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">@lang('claimProduct.photo')</label>
                            <div class="col-md-6">
                                @if ($errors->has('image'))
                                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('image') }})</span>
                                @endif
                                <div class="custom-file">
                                    <input type="file" class="form-control" name="image">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">@lang('claimProduct.deliveryAddress')</label>

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
                                @if ($errors->has('warranty_id'))
                                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('warranty_id') }})</span>
                                @endif
                                <button type="submit" class="btn">
                                    @lang('claimProduct.claimProduct')
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="register-form">
                    <h4>@lang('claimProduct.claimsCondition')</h4><hr>
                    <p><i class="fa fa-caret-right"></i> @lang('claimProduct.claimsCondition_1')</p> 
                    <p><i class="fa fa-caret-right"></i> @lang('claimProduct.claimsCondition_2')</p> 
                    <p><i class="fa fa-caret-right"></i> @lang('claimProduct.claimsCondition_3')</p> 
                    <p><i class="fa fa-caret-right"></i> @lang('claimProduct.claimsCondition_4')</p>
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
