<!DOCTYPE html>
<html class="no-js" lang="en">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0 shrink-to-fit=no"/>
    	<meta name="csrf-token" content="{{ csrf_token() }}">
		<title>PTK888</title>
		<meta name="author" content="codepixer">
		<meta name="description" content="">
		<meta name="keywords" content="">
		<style>
			@import url('https://fonts.googleapis.com/css2?family=Mitr:wght@200&display=swap');
		</style>
		@include("/backend/layouts/css/css")
	</head>
	<body>
		<div class="theme-loader">
			<div class="loader-track">
				<div class="preloader-wrapper">
					<div class="spinner-layer spinner-blue">
						<div class="circle-clipper left">
							<div class="circle"></div>
						</div>
						<div class="gap-patch">
							<div class="circle"></div>
						</div>
						<div class="circle-clipper right">
							<div class="circle"></div>
						</div>
					</div>
					<div class="spinner-layer spinner-red">
						<div class="circle-clipper left">
							<div class="circle"></div>
						</div>
						<div class="gap-patch">
							<div class="circle"></div>
						</div>
						<div class="circle-clipper right">
							<div class="circle"></div>
						</div>
					</div>
				  
					<div class="spinner-layer spinner-yellow">
						<div class="circle-clipper left">
							<div class="circle"></div>
						</div>
						<div class="gap-patch">
							<div class="circle"></div>
						</div>
						<div class="circle-clipper right">
							<div class="circle"></div>
						</div>
					</div>
				  
					<div class="spinner-layer spinner-green">
						<div class="circle-clipper left">
							<div class="circle"></div>
						</div>
						<div class="gap-patch">
							<div class="circle"></div>
						</div>
						<div class="circle-clipper right">
							<div class="circle"></div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div id="pcoded" class="pcoded">
			<div class="pcoded-overlay-box"></div>
			<div class="pcoded-container navbar-wrapper">
				@include("/backend/layouts/navbar-top/navbar-admin")
				<div class="pcoded-main-container">
					<div class="pcoded-wrapper">
						@include("/backend/layouts/navbar-left/navbar-admin")
						<div class="pcoded-content">
							@include("/backend/layouts/top-bar/topbar-admin")
							<div class="pcoded-inner-content">
								@yield("content")
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		@include("/backend/layouts/js/js")
	</body>
</html>