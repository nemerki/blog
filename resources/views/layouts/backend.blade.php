<!DOCTYPE html>

<html lang="en" >
<!-- begin::Head -->
<head>


    <title>@yield('tittle', config('app.name'))</title>
    @include("layouts.include.backend.head")
    @stack("customCss")

</head>
<!-- end::Head -->
<!-- end::Body -->
<body  class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
<!-- begin:: Page -->
<div class="m-grid m-grid--hor m-grid--root m-page">
    <!-- BEGIN: Header -->
@include("layouts.include.backend.header")
    <!-- END: Header -->
    <!-- begin::Body -->
    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
        <!-- BEGIN: Left Aside -->
        <button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn">
            <i class="la la-close"></i>
        </button>
        <div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">
            <!-- BEGIN: Aside Menu -->
        @include("layouts.include.backend.sidebar")
            <!-- END: Aside Menu -->
        </div>
        <!-- END: Left Aside -->
        @yield("content")
    </div>
    <!-- end:: Body -->
    <!-- begin::Footer -->
@include("layouts.include.backend.footer")
    <!-- end::Footer -->
</div>
<!-- end:: Page -->
<!-- begin::Quick Sidebar -->
@include("layouts.include.backend.quickSidebar")
<!-- end::Quick Sidebar -->
<!-- begin::Scroll Top -->
<div id="m_scroll_top" class="m-scroll-top">
    <i class="la la-arrow-up"></i>
</div>
<!-- end::Scroll Top -->		    <!-- begin::Quick Nav -->

<!--begin::Base Scripts -->
<script src="{{asset("assets/backend/vendors/base/vendors.bundle.js")}}" type="text/javascript"></script>
<script src="{{asset("assets/backend/demo/default/base/scripts.bundle.js")}}" type="text/javascript"></script>
<!--end::Base Scripts -->
<!--begin::Page Vendors -->
<script src="{{asset("assets/backend/vendors/custom/fullcalendar/fullcalendar.bundle.js")}}" type="text/javascript"></script>
<!--end::Page Vendors -->
<!--begin::Page Snippets -->
<script src="{{asset("assets/backend/app/js/dashboard.js")}}" type="text/javascript"></script>
<!--end::Page Snippets -->

@stack("customJs")
</body>
<!-- end::Body -->
</html>

