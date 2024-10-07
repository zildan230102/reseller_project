<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	@include('includes.public.style')

</head>

<body>
<!-- incude buat header -->
	@include('includes.public.header')

<!-- include buat body -->
	@yield('content')

    <footer>
        @include('includes.public.footer')
    </footer>

	@include('includes.public.script')

</body>

</html>