<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('frontend.includes.meta')
    @include('frontend.includes.styles')
</head>
<body data-plugin-page-transition>
<div class="body">
    @include('frontend.includes.navbar')
    @yield('front')
{{--    @include('frontend.includes.footer')--}}
    @include('sweetalert::alert')
    @include('frontend.includes.scripts')
</div>
@yield('scripts')
</body>
</html>
