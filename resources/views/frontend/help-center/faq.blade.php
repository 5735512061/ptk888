@extends("/frontend/layouts/template/template")
<link rel="stylesheet" type="text/css" href="{{ asset('css/faq-accordion.css')}}">
@section("content")
<div class="container-fluid">
    <center><h2>FAQ<hr width="50px;" style="border-top:5px solid rgb(255 194 49 / 47%)"></h2></center>
</div><br>

<div class="container-fluid" style="margin-bottom: 20px;">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-4">
            <div class="b-faq">
                <div class="faq__item">
                    <a href="#" class="faq__title js-faq-title">
                        <div class="faq__spoiler js-faq-rotate"><span class="faq__symbol ">+</span></div> 
                        <span class="faq__text">Заголовок не очень длинный</span>
                    </a>
                    <div class="faq__content js-faq-content">
                        Здесь контент<br/>
                        Здесь контент<br/>
                        Здесь контент<br/>
                        Здесь контент<br/>
                        Здесь контент<br/>
                        Здесь контент<br/>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="b-faq">
                <div class="faq__item">
                    <a href="#" class="faq__title js-faq-title">
                        <div class="faq__spoiler js-faq-rotate"><span class="faq__symbol ">+</span></div> 
                        <span class="faq__text">Заголовок не очень длинный</span>
                    </a>
                    <div class="faq__content js-faq-content">
                        Здесь контент
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
	

<script type="text/javascript" src="{{asset('https://code.jquery.com/jquery-3.2.1.min.js')}}"></script>
<script src="https://code.jquery.com/jquery-2.1.4.js"></script>
<script>
    $(function() {
	
	//BEGIN
	$(".js-faq-title").on("click", function(e) {

		e.preventDefault();
		var $this = $(this);

		if (!$this.hasClass("faq__active")) {
			$(".js-faq-content").slideUp(800);
			$(".js-faq-title").removeClass("faq__active");
			$('.js-faq-rotate').removeClass('faq__rotate');
		}

		$this.toggleClass("faq__active");
		$this.next().slideToggle();
		$('.js-faq-rotate',this).toggleClass('faq__rotate');
	});
	//END
	
});
</script>

@endsection