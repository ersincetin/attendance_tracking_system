
<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('Title')</title>
    @yield('Meta')
    <link rel="canonical" href="https://keenthemes.com/metronic" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <link href="{{asset("plugins/global/plugins.bundle.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("plugins/custom/prismjs/prismjs.bundle.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("css/style.bundle.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("css/themes/layout/header/base/light.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("css/themes/layout/header/menu/light.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("css/themes/layout/brand/dark.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("css/themes/layout/aside/dark.css")}}" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="{{asset("media/logos/favicon.ico")}}" />
    @yield('Css')
</head>
<body class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading" style="background-image: url({{asset("media/bg/bg-3.jpg")}});">
<div class="d-flex flex-column flex-root">
    @yield('Body')
</div>
<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>

<script src="{{asset("plugins/global/plugins.bundle.js")}}"></script>
<script src="{{asset("plugins/custom/prismjs/prismjs.bundle.js")}}"></script>
<script src="{{asset("js/scripts.bundle.js")}}"></script>
@yield('Javascript')
</body>
</html>
