@extends("/frontend/layouts/template/template")

@section('content')
<!-- Login Start -->
<div class="login">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">    
                <div class="register-form">
                    <h3>@lang('registerWarranty.filmWarrantyRegistration')</h3><hr>
                    <form action="{{url('member/register-warranty')}}" enctype="multipart/form-data" method="post">@csrf
                        @csrf
                        <div class="flash-message">
                            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                @if(Session::has('alert-' . $msg))
                                    <p class="alertdesign alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                                @endif
                            @endforeach
                        </div>
                        <div class="form-group row">
                            
                            <label class="col-md-4 col-form-label text-md-right">@lang('registerWarranty.first_name')</label>

                            <div class="col-md-6">
                                @if ($errors->has('name'))
                                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('name') }})</span>
                                @endif
                                <input type="text" class="form-control" name="name" value="{{auth('member')->user()->name}}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">@lang('registerWarranty.last_name')</label>

                            <div class="col-md-6">
                                @if ($errors->has('surname'))
                                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('surname') }})</span>
                                @endif
                                <input type="text" class="form-control" name="surname" value="{{auth('member')->user()->surname}}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">@lang('registerWarranty.mobile')</label>

                            <div class="col-md-6">
                                @if ($errors->has('phone'))
                                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('phone') }})</span>
                                @endif
                                <input type="text" class="form-control phone_format" name="phone" value="{{auth('member')->user()->phone}}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">@lang('registerWarranty.typeOfHydrogelFilm')</label>
                            <div class="col-md-6">
                                @if ($errors->has('film_model'))
                                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('film_model') }})</span>
                                @endif
                                <select name="film_model" class="form-control">
                                    <option value="Madam Film">Madam Film</option>
                                    <option value="Dora Shield">Dora Shield</option>
                                    <option value="บูธ PTK888">@lang('registerWarranty.booth')</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">@lang('registerWarranty.serialnumber')</label>

                            <div class="col-md-6">
                                @if ($errors->has('serialnumber'))
                                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('serialnumber') }})</span>
                                @endif
                                <input type="text" id="ssn" maxlength="19" minlength="19" class="form-control" name="serialnumber" value="{{ old('serialnumber') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">@lang('registerWarranty.brand')/@lang('registerWarranty.mobileModel')</label>

                            <div class="col-md-6">
                                @if ($errors->has('phone_model'))
                                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('phone_model') }})</span>
                                @endif
                                <input type="text" class="form-control" name="phone_model" value="{{ old('phone_model') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">@lang('registerWarranty.orderDate')</label>

                            <div class="col-md-6">
                                @if ($errors->has('date_order'))
                                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('date_order') }})</span>
                                @endif
                                <input type="text" class="form-control" name="date_order" value="{{ old('date_order') }}" placeholder="ตัวอย่าง เช่น 01/01/2021">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">@lang('registerWarranty.servicePoint')</label>
                            <div class="col-md-6">
                                @if ($errors->has('service_point'))
                                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('service_point') }})</span>
                                @endif
                                <select name="service_point" class="form-control">
                                    <option value="ตัวแทนจำหน่าย">@lang('registerWarranty.agency')</option>
                                    <option value="เว็บไซต์ออนไลน์">@lang('registerWarranty.website')</option>
                                    <option value="บูธ PTK888">@lang('registerWarranty.booth')</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">@lang('registerWarranty.location')</label>

                            <div class="col-md-6">
                                @if ($errors->has('address_service'))
                                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('address_service') }})</span>
                                @endif
                                <input type="text" class="form-control" placeholder="เช่น ร้านติดฟิล์มภูเก็ตหรือร้านค้าออนไลน์" name="address_service" value="{{ old('address_service') }}">
                            </div>
                        </div>
                        <input type="hidden" name="date" id="datepicker">
                        <input type="hidden" name="member_id" value="{{auth('member')->user()->id}}">

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn">
                                    @lang('registerWarranty.film_insurance_registration')
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="register-form">
                    <h6>@lang('warrantyInformation.condition')</h6><hr>
                    <p><i class="fa fa-caret-right"></i> @lang('warrantyInformation.condition_1')</p> 
                    <p><i class="fa fa-caret-right"></i> @lang('warrantyInformation.condition_2')</p> 
                    <p><i class="fa fa-caret-right"></i> @lang('warrantyInformation.condition_3')</p>
                    <p><i class="fa fa-caret-right"></i> @lang('warrantyInformation.condition_4')</p>
                    <p><i class="fa fa-caret-right"></i> @lang('warrantyInformation.condition_5')</p>
                    <p><i class="fa fa-caret-right"></i> @lang('warrantyInformation.condition_6')</p>
                    <br><h6>@lang('warrantyInformation.cliam_product')</h6><hr>
                    <p><i class="fa fa-caret-right"></i> @lang('warrantyInformation.register')</p>
                    <p><i class="fa fa-caret-right"></i> @lang('warrantyInformation.claim_1') <a href="{{url('/member/claim-product')}}">@lang('warrantyInformation.claim_2')</a></p>
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
<script>
    // date
    $('#datepicker').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        todayHighlight: true,
    });
    $('#datepicker').datepicker("setDate", new Date());
</script>
<script>
    // serial number
    $('#ssn').keyup(function() {
        var val = this.value.replace(/\D/g, '');
        var newVal = '';
        while (val.length > 4) {
          newVal += val.substr(0, 4) + ' ';
          val = val.substr(4);
        }
        newVal += val;
        this.value = newVal;
    });
</script>
@endsection
