@extends("/backend/layouts/template/template-seller")

@section("content")
<div class="main-body">
    <div class="page-wrapper">
        <div class="page-body">
            <div class="card table-card">
                <div class="card-header">
                    <h5>ค้นหาข้อมูลการประกันสินค้า</h5>
                </div><br>
                <div class="card-block">
                    <form action="{{url('/seller/search-data-warranty')}}" enctype="multipart/form-data" method="post">@csrf
                        <div class="row" style="margin-left: 5px;">
                            <div class="col-md-3">
                                <input type="text" name="member_id" class="form-control" placeholder="ค้นหารหัสสมาชิก"><br>
                                <button type="submit" class="btn btn-mat waves-effect waves-light btn-primary">ค้นหารหัสสมาชิก</button>
                            </div>
                            <div class="col-md-3">
                                <input id="ssn" maxlength="19" minlength="19" type="text" name="serialnumber" class="form-control" placeholder="ค้นหาหมายเลขซีเรียล"><br>
                                <button type="submit" class="btn btn-mat waves-effect waves-light btn-primary">ค้นหาหมายเลขซีเรียล</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h5>ข้อมูลการประกันสินค้า</h5>
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
                                    <th>ชื่อ-นามสกุล</th>
                                    <th>เบอร์โทรศัพท์</th>
                                    <th>ยี่ห้อโทรศัพท์</th>
                                    <th>ยี่ห้อฟิล์ม</th>
                                    <th>หมายเลขซีเรียล</th>
                                    <th>วันที่สั่งซื้อ</th>
                                    <th>จุดที่ใช้บริการ</th>
                                    <th>สถานที่จุดบริการ</th>
                                    <th>ระยะเวลาเคลม</th>
                                    <th>เวลาที่เหลือ</th>
                                    <th>สถานะ</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_warrantys as $data_warranty => $value)
                                    <tr>
                                        <th scope="row">{{$NUM_PAGE*($page-1) + $data_warranty+1}}</th>
                                        @php
                                            $name = DB::table('members')->where('id',$value->member_id)->value('name');
                                            $surname = DB::table('members')->where('id',$value->member_id)->value('surname');
                                            $phone = DB::table('members')->where('id',$value->member_id)->value('phone');
                                            $member_id = DB::table('members')->where('id',$value->member_id)->value('member_id');
                                            $status = DB::table('warranty_confirms')->where('warranty_id',$value->id)->value('status');
                                        @endphp
                                        <td>{{$member_id}}</td>
                                        <td>{{$name}} {{$surname}}</td>
                                        <td>{{$phone}}</td>
                                        <td>{{$value->phone_model}}</td>
                                        <td>{{$value->film_model}}</td>
                                        <td>{{$value->serialnumber}}</td>
                                        <td>{{$value->date_order}}</td>
                                        <td>{{$value->service_point}}</td>
                                        <td>{{$value->address_service}}</td>
                                        @php
                                            $warranty_time = DB::table('warranty_times')->where('film_brand',$value->film_model)->value('time');
                                            $date_product_out = DB::table('product_outs')->where('serialnumber',$value->serialnumber)->value('date');
                                            $date_warranty = date('Y-m-d', strtotime($date_product_out. ' + '.$warranty_time.' days'));

                                            $date_warranty_format = date('Y-m-d',strtotime($date_product_out));

                                            $date_warranty_start = date_create($date_warranty_format);
                                            $date_now_end = date_create($date_now);
                                            $diff = date_diff($date_warranty_start,$date_now_end);

                                            $numberDays = $warranty_time - $diff->format("%a");
                                        @endphp
                                        <td>{{$warranty_time}} วัน</td>
                                        @if($numberDays < 0)
                                            <td style="color: red;">0 วัน</td>
                                        @else
                                            <td style="color: red;">{{$numberDays}} วัน</td>
                                        @endif
                                        <td>
                                            @if($status == null || $status == "ยังไม่เคลม")
                                            <p style="color:red; font-size:15px;">ยังไม่เคลม</p> 
                                            @elseif($status == "รอยืนยัน")
                                                <p style="color:blue; font-size:15px;">รอยืนยัน</p>
                                            @elseif($status == "เคลมแล้ว")
                                                <p style="color:green; font-size:15px;">เคลมสินค้าแล้ว</p>
                                            @endif
                                        </td>
                                        <td>           
                                            <a href="{{url('/seller/delete-data-warranty/')}}/{{$value->id}}" onclick="return confirm('Are you sure to delete ?')">
                                                <i class="fa fa-trash" style="color:red;"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            {{$data_warrantys->links()}}
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