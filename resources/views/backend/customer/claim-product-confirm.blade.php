@extends("/frontend/layouts/template/template")

@section("content")
<div class="container-fluid">
    <center><h2>@lang('claimProductConfirm.productClaimInformation')<hr class="col-md-1 col-1" style="border-top:5px solid rgb(255 194 49 / 47%)"></h2></center>
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
                                    <th>@lang('claimProductConfirm.filmVersion')</th>
                                    <th>@lang('claimProductConfirm.mobileModel')</th>
                                    <th>@lang('claimProductConfirm.registerDate')</th>
                                    <th>@lang('claimProductConfirm.periodOfClaim')</th>
                                    <th>@lang('claimProductConfirm.timeLeft')</th>
                                    <th>@lang('claimProductConfirm.status')</th>
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
                                            $date_product_out = DB::table('product_outs')->where('serialnumber',$value->serialnumber)->value('date');
                                            $date_warranty = date('Y-m-d', strtotime($date_product_out. ' + '.$warranty_time.' days'));

                                            $date_warranty_format = date('Y-m-d',strtotime($date_product_out));

                                            $date_warranty_start = date_create($date_warranty_format);
                                            $date_now_end = date_create($date_now);
                                            $diff = date_diff($date_warranty_start,$date_now_end);

                                            $numberDays = $warranty_time - $diff->format("%a");
                                        @endphp
                                        <td>{{$warranty_time}} @lang('claimProductConfirm.days')</td>
                                        @if($numberDays < 0)
                                            <td style="color: red;">0 @lang('claimProductConfirm.days')</td>
                                        @else
                                            <td style="color: red;">{{$numberDays}} @lang('claimProductConfirm.days')</td>
                                        @endif
                                        <td>
                                            @if($status == null || $status == 'ยังไม่เคลม')
                                                <p style="color: red;">@lang('claimProductConfirm.notYetClaiming')</p>
                                            @elseif($status == 'รอยืนยัน')
                                                <p style="color:blue;">@lang('claimProductConfirm.waitingToConfirm')</p>
                                            @else
                                                <p style="color:green;">@lang('claimProductConfirm.claimed')</p>
                                            @endif
                                        </td>
                                        <td>   
                                            @if($numberDays != 0)
                                                @if($status == null || $status == 'ยังไม่เคลม')
                                                    <a href="{{url('/member/claim-product-form')}}/{{$value->id}}">
                                                        <p style="color:blue; font-family:'Mitr';">@lang('claimProductConfirm.submitYourClaim')</p>
                                                    </a> 
                                                @elseif($status == 'รอยืนยัน')
                                                    <p style="color:blue;">@lang('claimProductConfirm.waitingForConfirmation')</p>
                                                @else
                                                    <p style="color:green;">@lang('claimProductConfirm.claimed_product')</p>
                                                @endif
                                            @elseif($numberDays == 0) 
                                                <p style="color:red;">@lang('claimProductConfirm.timeOutToClaim')</p>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            {{$data_warrantys->links()}}
                        </table>
                    </div>
                    <h4>@lang('claimProductConfirm.claimsCondition')</h4><hr>
                    <p><i class="fa fa-caret-right"></i> @lang('claimProductConfirm.claimsCondition_1')</p> 
                    <p><i class="fa fa-caret-right"></i> @lang('claimProductConfirm.claimsCondition_2')</p> 
                    <p><i class="fa fa-caret-right"></i> @lang('claimProductConfirm.claimsCondition_3')</p> 
                    <p><i class="fa fa-caret-right"></i> @lang('claimProductConfirm.claimsCondition_4')</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection