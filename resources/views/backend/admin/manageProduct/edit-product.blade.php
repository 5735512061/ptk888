@extends("/backend/layouts/template/template-admin")

@section("content")
<div class="main-body">
    <div class="page-wrapper">
        <div class="page-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>แก้ไขข้อมูลสินค้า</h5>
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
                            <form action="{{url('/admin/update-product')}}" enctype="multipart/form-data" method="post">@csrf
                                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                    @if(Session::has('alert-' . $msg))
                                        <p class="alertdesign alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                                    @endif
                                @endforeach
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">รหัสสินค้า</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="product_code" value="{{$product->product_code}}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">ประเภทผลิตภัณฑ์</label>
                                    <div class="col-sm-10">
                                        <select name="category_id" class="form-control">
                                                @php
                                                    $category = DB::table('categorys')->where('id',$product->category_id)->value('category');
                                                    $category_id = DB::table('categorys')->where('id',$product->category_id)->value('id');
                                                @endphp
                                                <option value="{{$category_id}}">{{$category}}</option>
                                            @foreach ($categorys as $category => $value)
                                                <option value="{{$value->id}}">{{$value->category}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">ยี่ห้อฟิล์ม</label>
                                    <div class="col-sm-10">
                                        <select name="film_model" class="form-control">
                                            <option value="{{$product->film_model}}">{{$product->film_model}}</option>
                                            <option value="Madam Film">Madam Film</option>
                                            <option value="Dora Film">Dora Film</option>
                                            <option value="Raiguard Film">Raigrad Film</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">ยี่ห้อโทรศัพท์</label>
                                    <div class="col-sm-10">
                                        <select name="brand_id" class="form-control" id="brand">
                                                @php
                                                    $brand = DB::table('brands')->where('id',$product->brand_id)->value('brand');
                                                    $brand_id = DB::table('brands')->where('id',$product->brand_id)->value('id');
                                                @endphp
                                                <option value="{{$brand_id}}">{{$brand}}</option>
                                            @foreach ($brands as $brand => $value)
                                                <option value="{{$value->id}}">{{$value->brand}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">รุ่นโทรศัพท์</label>
                                    <div class="col-sm-10">
                                        <select name="phone_model_id" class="form-control" id="model">
                                            @php
                                                $model = DB::table('phone_models')->where('id',$product->phone_model_id)->value('model');
                                                $model_id = DB::table('phone_models')->where('id',$product->phone_model_id)->value('id');
                                            @endphp
                                            <option value="{{$model_id}}">{{$model}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">ประเภทของฟิล์ม</label>
                                    <div class="col-sm-10">
                                        <select name="product_type" class="form-control">
                                            <option value="{{$product->product_type}}">{{$product->product_type}}</option>
                                            <option value="ไม่มีประเภทของสินค้า">ไม่มีประเภทของสินค้า</option>
                                            @foreach ($film_types as $film_type => $value)
                                                <option value="{{$value->film_type}}">{{$value->film_type}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">ชื่อสินค้า</label>
                                    <div class="col-sm-10">
                                        @if ($errors->has('product_name'))
                                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('product_name') }})</span>
                                        @endif
                                        <input type="text" class="form-control" placeholder="กรุณากรอกชื่อสินค้า" name="product_name" value="{{$product->product_name}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">รายละเอียดสินค้า</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" placeholder="รายละเอียดของสินค้า (ถ้ามี)" name="detail" value="{{$product->detail}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">คุณสมบัติสินค้า</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" placeholder="คุณสมบัติของสินค้า (ถ้ามี)" name="property" value="{{$product->property}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">สถานะ</label>
                                    <div class="col-sm-10">
                                        <select name="status" class="form-control">
                                            <option value="{{$product->status}}">{{$product->status}}</option>
                                            <option value="แสดงสินค้า">แสดงสินค้า</option>
                                            <option value="ซ่อนสินค้า">ซ่อนสินค้า</option>
                                    </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">สินค้าแนะนำ</label>
                                    <div class="col-sm-10">
                                        <select name="product_recommend" class="form-control">
                                            <option value="{{$product->product_recommend}}">{{$product->product_recommend}}</option>
                                            <option value="ไม่ใช่">ไม่ใช่</option>
                                            <option value="ใช่">ใช่</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">อัพโหลดรูปภาพ</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" name="image[]" multiple>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-4 offset-md-2">
                                        <input type="hidden" name="id" value="{{$product->id}}">
                                        <button type="submit" class="btn btn-mat waves-effect waves-light btn-primary">อัพโหลดสินค้า</button>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
    $('#brand').on('change',function(e){
    console.log(e);
    var brand_id = e.target.value;
        //ajax
        $.get('../ajax-brand?cat_id=' + brand_id,function(data){
            $('#model').empty();
            $.each(data, function(index, subcatObj){
                $('#model').append('<option value="'+subcatObj.id+'">'+subcatObj.model+'</option>'); 
            });
        });
    });
</script>
@endsection