<!-- Top bar Start -->
<div class="top-bar">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6"></div>
            <div class="col-sm-6">
                @if(Auth::guard('member')->user() == NULL)
                    <a href="{{url('/register-member')}}" class="btn cart">@lang('navbar.register')</a> / <a class="btn cart" href="{{url('/member/login')}}">@lang('navbar.login')</a>
                @endif
                @if(Auth::guard('member')->user() != NULL)
                    @lang('navbar.hi')! {{Auth::guard('member')->user()->name}} {{Auth::guard('member')->user()->surname}}<br>
                    <a href="{{url('/member/profile')}}">@lang('navbar.account')</a> <a style="border-right: 3px solid rgba(0, 0, 0, 0.527) !important; margin-right:5px;"></a> <a href="{{ route('member.logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    @lang('navbar.logOut')
                    </a>
                    <form id="logout-form" action="{{ 'App\Member' == Auth::getProvider()->getModel() ? route('member.logout') : route('member.logout') }}" method="POST" style="display: none;">@csrf</form>
                @endif
                <a href="{{url('/locale/th')}}">TH</a>
                <a href="{{url('/locale/en')}}">EN</a>
            </div>
        </div>
    </div>
</div>
<!-- Top bar End -->

<!-- Nav Bar Start -->
<div class="nav">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-md bg-dark navbar-dark">
            <a href="#" class="navbar-brand">MENU</a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            @php
                if(\Session::get('locale') == null) {
                    $categorys = DB::table('categorys')->get();
                    $brands = DB::table('brands')->paginate('7');
                }
                
                elseif(\Session::get('locale') != null) {
                    $categorys = DB::table('categorys')->select('category_en','category_'.\Session::get('locale'))->get();
                    $brands = DB::table('brands')->paginate('7');
                }
            @endphp
            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav mr-auto">
                    <a href="{{url('/')}}" class="nav-item nav-link">@lang('navbar.main_page')</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" style="color: #000 !important;">@lang('navbar.product')</a>
                        <div class="dropdown-menu">
                            @foreach ($categorys as $category => $value)
                                @if(\Session::get('locale') == "th")
                                    <a href="{{url('/category')}}/{{$value->category_en}}" class="dropdown-item">{{$value->category_th}}</a>
                                @elseif(\Session::get('locale') == "en")
                                    <a href="{{url('/category')}}/{{$value->category_en}}" class="dropdown-item">{{$value->category_en}}</a>
                                @else 
                                    <a href="{{url('/category')}}/{{$value->category_en}}" class="dropdown-item">{{$value->category_th}}</a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" style="color: #000 !important;">@lang('navbar.product_by_type')</a>
                        <div class="dropdown-menu">
                            @foreach ($brands as $brand => $value)
                                <a href="{{url('/brand')}}/{{$value->brand_eng}}" class="dropdown-item">{{$value->brand_eng}}</a>
                            @endforeach
                                <a href="{{url('/all-brand')}}" class="dropdown-item">All Brand</a>
                        </div>
                    </div>
                    <a href="{{url('/dealer-shop')}}" class="nav-item nav-link">@lang('navbar.agency')</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" style="color: #000 !important;">@lang('navbar.help')</a>
                        <div class="dropdown-menu">
                            <a href="{{url('/warranty-information')}}" class="dropdown-item">@lang('navbar.insurance_information')</a>
                            <a href="{{url('/member/claim-product')}}" class="dropdown-item">@lang('navbar.claim_product')</a>
                            <a href="{{url('/howto-install')}}" class="dropdown-item">@lang('navbar.install_procedure')</a>
                            <a href="{{url('/faq')}}" class="dropdown-item">FAQ</a>
                        </div>
                    </div>
                    <a href="{{url('/promotion')}}" class="nav-item nav-link">@lang('navbar.promotion')</a>
                    <a href="{{url('/about-us')}}" class="nav-item nav-link">@lang('navbar.about_us')</a>
                    <a href="{{url('/contact-us')}}" class="nav-item nav-link">@lang('navbar.contact_us')</a>
                </div>
                <a id="desktop" href="{{url('/member/register-warranty')}}" class="nav-item nav-link" style="background-color: #ff8930; color:#fff;">@lang('navbar.film_insurance_registration')</a>
            </div>
        </nav>
    </div>
</div><hr style="margin-top: 0px; margin-bottom: 0px;">
<!-- Nav Bar End -->        