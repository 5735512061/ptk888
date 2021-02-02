<!DOCTYPE html>
<html class="no-js" lang="en">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0 shrink-to-fit=no"/>
    	<meta name="csrf-token" content="{{ csrf_token() }}">
		<title>LITTLE EDO</title>
		<meta name="author" content="codepixer">
		<meta name="description" content="">
		<meta name="keywords" content="">
		<style>
			@import url('https://fonts.googleapis.com/css2?family=Kanit:wght@200&display=swap');
		</style>
		@include("/frontend/layouts/css")
	</head>
	<body>
		@include("/frontend/layouts/navbar")
        @yield("content")
        @include("/frontend/layouts/footer")
		@include("/frontend/layouts/js")
	</body>
</html>