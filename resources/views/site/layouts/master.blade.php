<!DOCTYPE html>
<html lang="{{App::getLocale()}}" dir="{{App::getLocale() == 'ar' ? 'rtl' : 'ltr'}} ">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{awtTrans('title_website')}}</title>
    <link rel="icon" type="image/png" href="{{asset('website/img/head-logo.png')}}">
    @if(App::getLocale() == 'ar')
        <link rel="stylesheet" href="{{asset('website/css/bootstrap-rtl.min.css')}}">
    @else
        <link rel="stylesheet" href="{{asset('website/css/bootstrap.min.css')}}">
    @endif
    <link rel="stylesheet" href="{{asset('website/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('website/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('website/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('website/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('website/css/select2.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('website/css/jquery.fancybox.min.css')}}">
    <link rel="stylesheet" href="{{asset('website/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('website/css/iron-range.css')}}">
     @yield('meta')
    <style>
        .help-block{ color: red ; font-weight: bold }
    </style>
    @stack('style')
</head>

<body class="">
@include('sweetalert::alert')
<!--============================== start header ===========================-->
<header class="header">
    <div class="top-header">
        <div class="container">
            <div class="inner">
                <div class="icons">
                    {{awtTrans('حمل التطبيق الأن')}}
                    <a href="" target="_blank"><i class="fab fa-android"></i></a>
                    <a href="" target="_blank"><i class="fab fa-apple"></i></a>
                </div>
                <div class="dropdown lang">
                    <button class="" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-globe"></i>
                        {{App::getLocale() == 'ar' ? 'عربى ' : 'English'}}
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      @if(App::getLocale() == 'ar')
                         <a class="dropdown-item" href="{{url('language/en')}}">English</a>
                      @else
                        <a class="dropdown-item" href="{{url('language/ar')}}">عربى</a>
                      @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="nav-header">
            <a href="{{url('/')}}" class="logo">
                <img src="{{asset('website/img/logo.png')}}" alt="">
            </a>

            <ul class="nav-links">
                <li>
                    <a href="{{url('/')}}" class="link {{ request()->is('/') ? 'active' : '' }}">
                        {{awtTrans('الرئيسية')}}
                    </a>
                </li>
                <li>
                    <a href="{{url('live-shows')}}" class="link {{request()->is('live-shows') ? 'active' : '' }}">
                        {{awtTrans('العروض المباشره')}}
                    </a>
                </li>
                <li>
                    <a href="{{url('brokers')}}" class="link {{request()->is('brokers') ? 'active' : '' }}">
                        {{awtTrans('وسطاء عقاريون')}}
                    </a>
                </li>
                <li>
                    <a href="{{url('property-management')}}" class="link {{request()->is('property-management') ? 'active' : '' }}">
                        {{awtTrans('إدارة ملاك')}}
                    </a>
                </li>
                <li>
                    <a href="{{url('about')}}" class="link {{request()->is('about') ? 'active' : '' }}">
                        {{awtTrans('من نحن')}}
                    </a>
                </li>
                <li>
                    <a href="{{url('contact-us')}}" class="link {{request()->is('contact-us') ? 'active' : '' }}">
                        {{awtTrans('تواصل معنا')}}
                    </a>
                </li>
            </ul>
            <div class="left">
                @guest
                  <a href="{{url('sign-in')}}" class="sign-link">
                    <i class="fas fa-sign-in-alt sign-icon"></i>
                    <span>{{awtTrans('تسجيل دخول / جديد')}}</span>
                </a>
                @endguest
                @auth
                  <a href="{{url('account')}}" class="sign-link">
                    <i class="fas fa-sign-in-alt sign-icon"></i>
                    <span>{{awtTrans('حسابى')}}</span>
                </a>
                @endauth
                <button class="nav-btn"><span></span><span></span><span></span></button>
            </div>
        </div>
    </div>
    <div class="nav-overlay"></div>
</header>

<!--============================ end-header ================================-->

<!-- ============================ start content ========================== -->

<!--======================== end content ================================-->
@yield('content')
<!--========================= start footer ===============================-->
<footer class="footer">
    <div class="footer-section">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-3 col-sm-12">
                    <div class="img-footer">
                        <a href="{{url('/')}}" class="footer-logo">
                            <img src="{{asset('website/img/footer-logo.png')}}" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-12 col-lg-3 col-sm-12">
                    <p class="foot-title">{{awtTrans('روابط سريعة')}}</p>
                    <div class="links">
                        <a href="{{url('/')}}" class="link">{{awtTrans('الرئيسية')}}</a>
                        <a href="{{url('about')}}" class="link">{{awtTrans('من نحن')}}</a>
                        <a href="{{url('quest-calculator')}}" class="link">{{awtTrans('حاسبة السعي')}}</a>
                        <a href="{{url('commission-calculator')}}" class="link">{{awtTrans('حاسبة العمولة')}}</a>
                    </div>
                </div>
                <div class="col-12 col-lg-3 col-sm-12">
                    <p class="foot-title">{{awtTrans('روابط سريعة')}}</p>
                    <div class="links">
                        <a href="{{url('bank-accounts')}}" class="link">{{awtTrans('الحسابات البنكية')}}</a>
                        <a href="{{url('policy')}}" class="link">{{awtTrans('سياسة الاستخدام')}}</a>
                        <a href="{{url('terms')}}" class="link">{{awtTrans('الشروط والأحكام')}}</a>
                        @auth
                         <a href="{{url('account')}}" class="link">{{awtTrans('حسابي')}}</a>
                        @endauth
                    </div>
                </div>
                <div class="col-12 col-lg-3 col-sm-12">
                    <p class="foot-title">{{awtTrans('تواصل معنا')}}</p>
                    <div class="links">
                        <a href="tel:{{setting()['phone']}}" class="link">{{setting()['phone']}}</a>
                        <a href="https://api.whatsapp.com/send?phone={{setting()['whatsapp']}}&text=هلا" class="link" target="_blank">
                            {{setting()['whatsapp']}}
                        </a>
                        <a href="mailto:{{setting()['email']}}" class="link">{{setting()['email']}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copy-right">
        <div class="container">
            <p class="right">جميع الحقوق محفوظة لموقع تسكن</p>
            <p class="left">تصميم وبرمجة أوامر الشبكة</p>
        </div>
    </div>
</footer>
<!-- start to loader -->
<div id="loader">
    <img src="https://tskn-app.aait-sa.com/public/storage/images/features/top-logo.png" alt="" class="top">
    <img src="https://tskn-app.aait-sa.com/public/storage/images/features/bottom-logo.png" alt="" class="bottom">
    <img src="https://tskn-app.aait-sa.com/public/storage/images/features/top-text.png" alt="" class="text">
    <img src="https://tskn-app.aait-sa.com/public/storage/images/features/bottom-text.png" alt="" class="bottom-text">
</div>

{{--<table id="loader">--}}
{{--    <tr>--}}
{{--        <td>--}}
{{--            <div class="multi-spinner-container">--}}
{{--                <div class="multi-spinner">--}}
{{--                    <div class="multi-spinner">--}}
{{--                        <div class="multi-spinner">--}}
{{--                            <div class="multi-spinner">--}}
{{--                                <div class="multi-spinner">--}}
{{--                                    <div class="multi-spinner"></div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </td>--}}
{{--    </tr>--}}
{{--</table>--}}
<!--========================== end footer ================================-->
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script src="https://unpkg.com/@google/markerclustererplus@4.0.1/dist/markerclustererplus.min.js"></script>

<script src="{{asset('website/js/jquery-3.5.1.min.js')}}"></script>
<script src="{{asset('website/js/popper.min.js')}}"></script>
@if(App::getLocale() == 'ar')
    <script src="{{asset('website/js/bootstrap-rtl.min.js')}}"></script>
@else
    <script src="{{asset('website/js/bootstrap-rtl.min.js')}}"></script>
@endif
<script src="{{asset('website/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('website/js/wow.js')}}"></script>
<script src="{{asset('website/js/select2.js')}}"></script>
<script src="{{asset('website/js/jquery.fancybox.min.js')}}"></script>
<script src="{{asset('website/js/main.js')}}"></script>
<script src="{{asset('website/js/iron-range.js')}}"></script>
<script type="text/javascript" src="{{asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
<script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5d5bed61c60153001277bfb2&product=sop' async='async'></script>
<script>
    new WOW().init();
</script>
@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
@yield('scripts')
</body>

</html>
