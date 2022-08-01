<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Move POS | @yield('title')</title>

    <link rel="stylesheet" href="{{asset('css/main/app.css')}}">
    <link rel="apple-touch-icon" sizes="57x57" href="{{asset('images/logo/apple-icon-57x57.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{asset('images/logo/apple-icon-60x60.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{asset('images/logo/apple-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('images/logo/apple-icon-76x76.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{asset('images/logo/apple-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('images/logo/apple-icon-120x120.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{asset('images/logo/apple-icon-144x144.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('images/logo/apple-icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('images/logo/apple-icon-180x180.png')}}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{asset('images/logo/android-icon-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('images/logo/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('images/logo/favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/logo/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('images/logo/manifest.json')}}">
    <meta name="msapplication-TileColor" content="#435EBE">
    <meta name="msapplication-TileImage" content="{{asset('images/logo/ms-icon-144x144.png')}}">
    <meta name="theme-color" content="#435EBE">

    <link rel="stylesheet" href="{{asset('css/pages/toastify.css')}}">
    <link rel="stylesheet" href="{{asset('css/shared/iconly.css')}}">
    <link rel="stylesheet" href="{{asset('css/main/bs-stepper.min.css')}}">
    @livewireStyles()

    <style>
        .scroll{
            max-height: 760px;
            max-width: 100%;
            overflow-y:auto;
        }

        /* ===== Scrollbar CSS ===== */
        /* Firefox */
        .scroll {
            scrollbar-width: thin;
            scrollbar-color: #435beb #ffffff;
        }

        /* Chrome, Edge, and Safari */
        .scroll::-webkit-scrollbar {
            width: 10px;
        }

        /* *::-webkit-scrollbar-track {
            background: #ffffff;
        } */

        .scroll::-webkit-scrollbar-thumb {
            background-color: #0DCEF4;
            border-radius: 5px;

            /* border: 0.5px solid #585858; */
        }



    </style>


</head>

<body class="bg-primary">
    @stack('menu')
<div>
    @yield('content')
</div>


{{-- <script src="{{asset('js/pages/dashboard.js')}}"></script> --}}
<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('js/extensions/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('js/extensions/jquery.mask.js')}}"></script>
<script src="{{asset('js/extensions/bs-stepper.min.js')}}"></script>
<script src="{{asset('js/extensions/toastify-js.js')}}"></script>
@livewireScripts()
@stack('script')
</body>

</html>
