<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - Student Management Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('public/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('public/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('public/css/adminlte.css')}}">
    <link rel="stylesheet" href="{{asset('public/plugins/ccJquery/css/intlTelInput.css')}}">

    <style>
    /* .custom-tabs {
        background: rgba(255, 255, 255, 0.2) !important;
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37) !important;
        backdrop-filter: blur(4.5px) !important;
        -webkit-backdrop-filter: blur(4.5px) !important;
    } */

    /* .custom-bg {
        /*background: lightblue !important;*/
    /*background: linear-gradient(145deg, rgba(57,192,255,1) 40%, rgba(219,244,255,1) 60%) !important;*/

    /* background-image: url("public/img/bg1.jpg");
            height: 100%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;


        --gradient: linear-gradient(90deg, #fff, white, #fff);

        background: #ddd;
        background-image: var(--gradient);
        animation: bg-animation 5s infinite;

        @keyframes bg-animation {
            0% {
                background-position: left
            }

            50% {
                background-position: right
            }

            100% {
                background-position: left
            }

        }
    } */

    #vert-tabs-tab {
        height: 100vh !important;
        overflow-y: scroll !important;
        overflow-x: hidden !important;
        flex-wrap: nowrap !important;
    }

    .dropdown-menu:hover .dropdown-item:hover {
        background-color: #ffc266;
        color: #fff;
    }
    </style>


</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{asset('public/img/aceedu.jpeg')}}" alt="ACE Education Loading Logo"
                height="100" width="100">
        </div>