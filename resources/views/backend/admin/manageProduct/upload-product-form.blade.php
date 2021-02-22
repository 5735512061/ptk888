@extends("/backend/layouts/template/template-admin")

@section("content")
<div class="main-body">
    <div class="page-wrapper">
        <div class="page-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>อัพโหลดสินค้า</h5>
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
                        @php
                            $random = rand(111111,999999);  
                            $random_format = wordwrap($random , 4 , '-' , true );
                            $id = 'PTK-P-'.$random_format;
                            
                            $store_id = DB::table('stores')->where('store_id',$id)->value('store_id');
                                if($store_id == null) {
                                    $id_gen = $id;
                                } else {
                                    $random = rand(111111,999999);  
                                    $random_format = wordwrap($random , 4 , '-' , true );
                                    $id_gen = 'PTK-P-'.$random_format;
                                }
                        @endphp
                        <div class="card-block">
                            <form action="{{url('/admin/upload-product')}}" enctype="multipart/form-data" method="post">@csrf
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">ประเภทผลิตภัณฑ์</label>
                                    <div class="col-sm-10">
                                        <select name="category_id" class="form-control">
                                            @foreach ($categorys as $category => $value)
                                                <option value="{{$value->id}}">{{$value->category}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">ยี่ห้อผลิตภัณฑ์</label>
                                    <div class="col-sm-10">
                                        <select name="brand_id" class="form-control">
                                            <option value="ไม่มียี่ห้อของสินค้า">ไม่มียี่ห้อของสินค้า</option>
                                            @foreach ($brands as $brand => $value)
                                                <option value="{{$value->id}}">{{$value->brand}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">รหัสสินค้า</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="product_code" value="{{$id_gen}}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">ประเภทของสินค้า</label>
                                    <div class="col-sm-10">
                                        <select name="product_type" class="form-control">
                                                <option value="ไม่มีประเภทของสินค้า">ไม่มีประเภทของสินค้า</option>
                                                <option value="ฟิล์ม wolverine">ฟิล์ม wolverine</option>
                                                <option value="ฟิล์มกันมอง">ฟิล์มกันมอง</option>
                                                <option value="ฟิล์มใส">ฟิล์มใส</option>
                                                <option value="ฟิล์มด้าน">ฟิล์มด้าน</option>
                                                <option value="ฟิล์มถนอมสายตา">ฟิล์มถนอมสายตา</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">ชื่อสินค้า</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" placeholder="กรุณากรอกชื่อสินค้า" name="product_name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">รายละเอียดสินค้า</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" placeholder="รายละเอียดของสินค้า (ถ้ามี)" name="detail">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">คุณสมบัติสินค้า</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" placeholder="คุณสมบัติของสินค้า (ถ้ามี)" name="property">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">สถานะ</label>
                                    <div class="col-sm-10">
                                        <select name="status" class="form-control">
                                            <option value="SHOW">แสดงสินค้า</option>
                                            <option value="OFF">ซ่อนสินค้า</option>
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
@endsection