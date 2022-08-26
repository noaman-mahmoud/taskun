<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="rtl">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>@yield('title',isset(\Request::route()->getAction()['title']) ? awtTrans(\Request::route()->getAction()['title']) : '')</title>
    <link rel="apple-touch-icon" href="{{asset('storage/images/settings/fav_icon.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('storage/images/settings/fav_icon.png')}}">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}" />


    @if (lang() == 'ar')
        <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/vendors/css/vendors-rtl.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css-rtl/bootstrap.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css-rtl/bootstrap-extended.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css-rtl/colors.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css-rtl/components.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css-rtl/themes/dark-layout.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css-rtl/themes/semi-dark-layout.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css-rtl/core/menu/menu-types/vertical-menu.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css-rtl/core/colors/palette-gradient.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css-rtl/pages/dashboard-ecommerce.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css-rtl/pages/card-analytics.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css-rtl/custom-rtl.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/style.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/style-rtl.css')}}">
    @else
        <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/vendors/css/vendors.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css/bootstrap.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css/bootstrap-extended.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css/colors.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css/components.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css/themes/dark-layout.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css/themes/semi-dark-layout.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css/core/menu/menu-types/vertical-menu.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css/core/colors/palette-gradient.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css/pages/dashboard-ecommerce.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css/pages/card-analytics.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css/custom-rtl.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/style.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/style_en.css')}}">
    @endif

    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/vendors/css/charts/apexcharts.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/vendors/css/extensions/toastr.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css-rtl/plugins/extensions/toastr.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">

    @yield('css')

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->


<body style="font-family: 'Cairo', sans-serif !important;" id="content_body" class="position-relative vertical-layout vertical-menu-modern 2-columns  navbar-floating footer-static" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
    <div class="loader">
        <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>