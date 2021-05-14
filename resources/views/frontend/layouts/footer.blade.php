<!-- Footer Start -->
<div class="footer" style="color: #fff;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="logo">
                    <a href="{{url('/')}}">
                        @php
                            $image = DB::table('image_websites')->where('image_type','รูปภาพโลโก้')->value('image');
                        @endphp
                        <img src="{{url('/image_upload/image_website')}}/{{$image}}" alt="Logo" width="50%" class="img-responsive"> 
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="footer-widget">
                    <h2>@lang('footer.help')</h2>
                    <ul>
                        <li><a href="{{url('/warranty-information')}}">@lang('footer.insurance_information')</a></li>
                        <li><a href="{{url('/howto-install')}}">@lang('footer.install_procedure')</a></li>
                        <li><a href="{{url('/faq')}}">FAQ</a></li>
                    </ul>
                </div>
            </div>
            @php
                if(\Session::get('locale') == null) {
                    $categorys = DB::table('categorys')->get();
                }
                
                elseif(\Session::get('locale') != null) {
                    $categorys = DB::table('categorys')->select('category_en','category_'.\Session::get('locale'))->get();
                }
            @endphp
            <div class="col-lg-3 col-md-6">
                <div class="footer-widget">
                    <h2>@lang('footer.product')</h2>
                    <ul>
                        @foreach ($categorys as $category => $value)
                            @if(\Session::get('locale') == "th")
                                <li><a href="{{url('/category')}}/{{$value->category_en}}">{{$value->category_th}}</a></li>
                            @elseif(\Session::get('locale') == "en")
                                <li><a href="{{url('/category')}}/{{$value->category_en}}">{{$value->category_en}}</a></li>
                            @else 
                                <li><a href="{{url('/category')}}/{{$value->category_en}}">{{$value->category_th}}</a></li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="footer-widget">
                    <h2>@lang('footer.agency')</h2>
                    <ul>
                        <li><a href="{{url('/dealer-shop')}}">@lang('footer.searching_agency')</a></li>
                        <li><a href="{{url('/store/login')}}">@lang('footer.agency_member')</a></li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="row payment align-items-center">
            <div class="col-md-4"></div>
            <div class="col-md-6">
                <div class="payment-method">
                    <h2>@lang('footer.contact_us')</h2>
                    <div class="social">
                        <a href="https://www.facebook.com/ptkstudio8"><i class="fab fa-facebook-f"></i></a>
                        <a href="http://line.me/ti/p/~@499zvsgh"><i class="fab fa-line"></i></a>
                        <a href="https://instagram.com/ptk888.th?igshid=w2w4fz2js4k9"><i class="fab fa-instagram"></i></a>
                        <a href="#" data-toggle="tooltip" data-placement="top" title="ptkstudio8@gmail.com"><i class="fab fa fa-envelope"></i></a>
                        <a href="#" data-toggle="tooltip" data-placement="top" title="066-113-1689"><i class="fab fa fa-phone"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
</div>
<!-- Footer End -->

<!-- Footer Bottom Start -->
<div class="footer-bottom">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 copyright">
                <p>Copyright &copy; All Rights Reserved</p>
            </div>
        </div>
    </div>
</div>
<!-- Footer Bottom End -->       

<!-- Back to Top -->
<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

<script>
    $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip();   
    });
</script>