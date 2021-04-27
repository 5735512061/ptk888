@extends("/backend/layouts/template/template-store")

@section("content")
<div class="main-body">
    <div class="page-wrapper">
        <div class="page-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>นำสินค้าออก</h5>
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
                            <form action="{{url('/store/product-out')}}" enctype="multipart/form-data" method="post">@csrf
                                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                    @if(Session::has('alert-' . $msg))
                                        <p class="alertdesign alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                                    @endif
                                @endforeach
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">หมายเลขซีเรียล 16 หลัก</label>
                                    <div class="col-sm-10">
                                        @if ($errors->has('serialnumber'))
                                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('serialnumber') }})</span>
                                        @endif
                                        <input id="ssn" maxlength="19" minlength="19" type="text" class="form-control" placeholder="กรุณากรอกหมายเลขซีเรียล 16 หลัก" name="serialnumber">
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-4 offset-md-2">
                                        <button type="submit" class="btn btn-mat waves-effect waves-light btn-primary">นำสินค้าออก</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5>รายการสินค้าออก</h5>
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
                                    <th>หมายเลขซีเรียล 16 หลัก</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product_outs as $product_out => $value)
                                    <tr>
                                        <th scope="row">{{$NUM_PAGE*($page-1) + $product_out+1}}</th>
                                        @php
                                            $film_model = DB::table('serialnumbers')->where('id',$value->film_model_id)->value('film_model');
                                        @endphp
                                        <td>{{$film_model}}</td>
                                        <td>{{$value->serialnumber}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            {{$product_outs->links()}}
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{asset('https://code.jquery.com/jquery-3.2.1.min.js')}}"></script>
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