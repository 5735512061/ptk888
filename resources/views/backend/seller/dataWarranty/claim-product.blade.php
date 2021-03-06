@extends("/backend/layouts/template/template-seller")

@section("content")
<div class="main-body">
    <div class="page-wrapper">
        <div class="page-body">
            <div class="card table-card">
                <div class="card-header">
                    <h5>ค้นหาข้อมูลการเคลมสินค้า</h5>
                </div><br>
                <div class="card-block">
                    <form action="{{url('/seller/search-claim-product')}}" enctype="multipart/form-data" method="post">@csrf
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
                    <h5>ข้อมูลการเคลมสินค้า</h5>
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
                                    <th>วันที่เคลมสินค้า</th>
                                    <th>จุดที่ใช้บริการ</th>
                                    <th>สถานที่จุดบริการ</th>
                                    <th>สาเหตุการเคลม</th>
                                    <th>ที่อยู่จัดส่ง</th>
                                    <th>สถานะ</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($claim_products as $claim_product => $value)
                                    <tr>
                                        <th scope="row">{{$NUM_PAGE*($page-1) + $claim_product+1}}</th>
                                        @php
                                            $name = DB::table('members')->where('id',$value->member_id)->value('name');
                                            $surname = DB::table('members')->where('id',$value->member_id)->value('surname');
                                            $phone = DB::table('members')->where('id',$value->member_id)->value('phone');
                                            $member_id = DB::table('members')->where('id',$value->member_id)->value('member_id');
                                            $phone_model = DB::table('data_warranty_members')->where('id',$value->warranty_id)->value('phone_model');
                                            $film_model = DB::table('data_warranty_members')->where('id',$value->warranty_id)->value('film_model');
                                            $serialnumber = DB::table('data_warranty_members')->where('id',$value->warranty_id)->value('serialnumber');
                                            $date_order = DB::table('data_warranty_members')->where('id',$value->warranty_id)->value('date_order');
                                            $service_point = DB::table('data_warranty_members')->where('id',$value->warranty_id)->value('service_point');
                                            $address_service = DB::table('data_warranty_members')->where('id',$value->warranty_id)->value('address_service');
                                        @endphp
                                        <td>{{$member_id}}</td>
                                        <td>{{$name}} {{$surname}}</td>
                                        <td>{{$phone}}</td>
                                        <td>{{$phone_model}}</td>
                                        <td>{{$film_model}}</td>
                                        <td>{{$serialnumber}}</td>
                                        <td>{{$date_order}}</td>
                                        <td>{{$value->date}}</td>
                                        <td>{{$service_point}}</td>
                                        <td>{{$address_service}}</td>
                                        <td>
                                            <center>
                                                <a type="button" data-toggle="modal" data-target="#ModalReason{{$value->id}}">
                                                    <i class="fa fa-folder" style="color:blue;"></i>
                                                </a>
                                            </center>
                                        </td>
                                        <td>
                                            <center>
                                                <a type="button" data-toggle="modal" data-target="#ModalAddress{{$value->id}}">
                                                    <i class="fa fa-folder" style="color:blue;"></i>
                                                </a>
                                            </center>
                                        </td>
                                        <td>
                                            @if($value->status == null || $value->status == "ยังไม่เคลม")
                                                <p style="color:red; font-size:15px;">ยังไม่เคลม</p> 
                                            @elseif($value->status == "รอยืนยัน")
                                                <p style="color:blue; font-size:15px;">รอยืนยัน</p>
                                            @elseif($value->status == "เคลมแล้ว")
                                                <p style="color:green; font-size:15px;">เคลมสินค้าแล้ว</p>
                                            @endif
                                        </td>
                                        <td>       
                                            <a href="{{url('/seller/edit-claim-status')}}/{{$value->id}}">
                                                <i class="fa fa-pencil-square-o" style="color:blue;"></i>
                                            </a>        
                                        </td>
                                    </tr>
                                    <!-- Modal -->
                                    <div class="modal fade" id="ModalReason{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">สาเหตุการเคลม</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                                {{$value->reason}}<br>
                                                <img src="{{url('/image_upload/image_claim_product')}}/{{$value->image}}" class="img-responsive" width="100%">
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    <!-- Modal -->
                                    <div class="modal fade" id="ModalAddress{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">ที่อยู่จัดส่ง</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                                {{$value->address}}
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                            {{$claim_products->links()}}
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