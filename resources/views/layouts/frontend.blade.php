<!DOCTYPE html>
<html lang="en">

<head>

    <title>@yield('tittle', config('setting.tittle'))</title>
    @include("layouts.include.frontend.head")
    @stack("customCss")

</head>

<body>

@include("layouts.include.frontend.navbar")
@include("layouts.include.frontend.header")
@yield("content")
@include("layouts.include.frontend.footer")


<!-- Bootstrap core JavaScript -->
<script src="{{asset("assets/frontend/vendor/jquery/jquery.min.js")}}"></script>

<!-- Bootstrap Core JavaScript -->
<script src="{{asset("assets/frontend/vendor/bootstrap/js/bootstrap.min.js")}}"></script>
<script src="{{asset("assets/frontend/js/toastr.min.js")}}"></script>

<!-- Theme JavaScript -->
<script src="{{asset("assets/frontend/js/bootstrap-switch.min.js")}}"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="{{asset("assets/frontend/js/laravel-delete.js")}}"></script>
<script src="{{asset("assets/frontend/js/clean-blog.js")}}"></script>
<script src="{{asset("assets/frontend/js/custom.js")}}"></script>
@stack("customJs")
</body>

</html>
