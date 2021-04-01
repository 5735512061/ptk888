@extends("/frontend/layouts/template/template")

@section("content")
<div class="container-fluid">
    <center><h2>ข้อมูลการเคลมสินค้า<hr class="col-md-1 col-1" style="border-top:5px solid rgb(255 194 49 / 47%)"></h2></center>
</div><br>
<div class="login">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="register-form">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>รุ่นฟิล์ม</th>
                                    <th>รุ่นโทรศัพท์</th>
                                    <th>วันที่ลงทะเบียน</th>
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
                                        <td>{{$value->film_model}}</td>
                                        <td>{{$value->phone_model}}</td>
                                        <td>{{$value->date}}</td>
                                        @php
                                            $status = DB::table('warranty_confirms')->where('warranty_id',$value->id)->value('status');
                                            $warranty_time = DB::table('warranty_times')->where('film_brand',$value->film_model)->value('time');
                                            $date_warranty = date('d-m-Y', strtotime($value->date. ' + '.$warranty_time.' days'));

                                            $date_warranty_format = date('Y-m-d',strtotime($value->date));

                                            $date_warranty_start = date_create($date_warranty_format);
                                            $date_now_end = date_create($date_now);
                                            $diff = date_diff($date_warranty_start,$date_now_end);

                                            $numberDays = $warranty_time - $diff->format("%a");
                                        @endphp
                                        <td>{{$warranty_time}} วัน</td>
                                        <td style="color: red;">{{$numberDays}} วัน</td>
                                        <td>
                                            @if($status == null || $status == 'ยังไม่เคลม')
                                                <p style="color: red;">ยังไม่เคลม</p>
                                            @elseif($status == 'รอยืนยัน')
                                                <p style="color:blue;">รอยืนยัน</p>
                                            @else
                                                <p style="color:green;">เคลมแล้ว</p>
                                            @endif
                                        </td>
                                        <td>   
                                            @if($numberDays != 0)
                                                @if($status == null || $status == 'ยังไม่เคลม')
                                                    <a href="{{url('/member/claim-product-form')}}/{{$value->id}}">
                                                        <p style="color:blue; font-family:'Mitr';">กดเคลมสินค้า</p>
                                                    </a> 
                                                @elseif($status == 'รอยืนยัน')
                                                    <p style="color:blue;">กำลังรอยืนยัน</p>
                                                @else
                                                    <p style="color:green;">เคลมสินค้าแล้ว</p>
                                                @endif
                                            @elseif($numberDays == 0) 
                                                <p style="color:red;">หมดเวลาเคลมสินค้า</p>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            {{$data_warrantys->links()}}
                        </table>
                    </div>
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
@endsection