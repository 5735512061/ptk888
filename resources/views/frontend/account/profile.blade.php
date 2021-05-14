@extends("/frontend/layouts/template/template")

@section("content")
<div class="container-fluid">
    <center><h2>@lang('profile.personalInformation')<hr width="70px;" style="border-top:5px solid rgb(255 194 49 / 47%)"></h2></center>
</div><br>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <h2 style="text-align: center;">@lang('profile.customerID') {{$member->member_id}}</h2>
            <h1 style="text-align: center;">{{$member->name}} {{$member->surname}}</h1>
            <h2 style="text-align: center;">@lang('profile.mobile') {{$member->phone}}</h2><br>
            <h4 style="text-align: center;">@lang('profile.address') {{$member->address}} @lang('profile.sub_district'){{$member->district}} @lang('profile.district'){{$member->amphoe}} @lang('profile.province'){{$member->province}} {{$member->zipcode}}</h4>
        </div>
        <div class="col-md-4"></div>
    </div><br>
    <div class="row" style="margin-bottom: 20px;">
        <div class="col-md-3"></div>
        <div class="col-md-6" style="text-align: center;">
            <div class="row">
                <a class="col-md-6" href="{{url('/member/order-history')}}">
                    <button type="submit" class="btn" style="height: 70px; width: 20em; margin-bottom: 20px;">
                        <h4>@lang('profile.orderHistory')</h4> 
                    </button>
                </a>
                <a class="col-md-6" href="{{url('/member/answer-message')}}">
                    <button type="submit" class="btn" style="height: 70px; width: 20em; margin-bottom: 20px;">
                        <h4>@lang('profile.inquiryHistory')</h4> 
                    </button>
                </a>
                <a class="col-md-6" href="{{url('/member/shopping-cart')}}">
                    <button type="submit" class="btn" style="height: 70px; width: 20em; margin-bottom: 20px;">
                        <h4>@lang('profile.cart')</h4> 
                    </button>
                </a>
                <a class="col-md-6" href="{{url('/member/edit-profile')}}/{{$member->id}}">
                    <button type="submit" class="btn" style="height: 70px; width: 20em; margin-bottom: 20px;">
                        <h4>@lang('profile.editPersonalInformation')</h4> 
                    </button>
                </a>
                <a class="col-md-6" href="{{url('/member/change-password')}}">
                    <button type="submit" class="btn" style="height: 70px; width: 20em; margin-bottom: 20px;">
                        <h4>@lang('profile.changePassword')</h4> 
                    </button>
                </a>
                <a class="col-md-6" href="{{ route('member.logout') }}" 
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    <button type="submit" class="btn" style="height: 70px; width: 20em; margin-bottom: 20px;">
                        <h4>@lang('profile.logOut')</h4> 
                    </button>
                </a>
                <form id="logout-form" action="{{ 'App\Member' == Auth::getProvider()->getModel() ? route('member.logout') : route('member.logout') }}" method="POST" style="display: none;">@csrf</form>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>
@endsection