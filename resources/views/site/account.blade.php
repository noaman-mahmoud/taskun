@extends('site.layouts.master')

@section('content')
    <section class="content orange">

    <!-- banner- section -->
    <div class="banner-section banner-show" style="background-image: url({{url('website/img/banner-home.png')}});">
        <div class="container">
            <div class="info">
                <p class="title">{{awtTrans('حسابي')}}
                    {{Auth::user()->name}}
                </p>
            </div>
        </div>
    </div>

    <div class="owner-img">
        <div class="container">
            <img src="{{Auth::user()->avatar}}" alt="" class="img">
            <p class="hint">{{trans('apis.'.Auth::user()->user_type)}}</p>
            <div class="links-page">
                <a href="{{url('profile')}}">
                    {{awtTrans('المعلومات الشخصيه')}}
                    <i class="fas fa-angle-left"></i>
                </a>
                <a href="{{url('my-favorites')}}">
                    {{awtTrans('مفضلتي')}}
                    <i class="fas fa-angle-left"></i>
                </a>
                <a href="{{url('my-estates')}}" class="b-right">
                    {{awtTrans('اعلاناتي')}}
                    <i class="fas fa-angle-left"></i>
                </a>
                <a href="{{url('archived-estates')}}" class="b-right">
                    {{awtTrans('الأرشيف')}}
                    <i class="fas fa-angle-left"></i>
                </a>
                <a href="{{url('commission-calculator')}}">
                    {{awtTrans('حاسبة العمولة')}}
                    <i class="fas fa-angle-left"></i>
                </a>
                <a href="{{url('quest-calculator')}}">
                    {{awtTrans('حاسبة السعي')}}
                    <i class="fas fa-angle-left"></i>
                </a>
                <a href="{{url('bank-accounts')}}">
                    {{awtTrans('الحسابات البنكية')}}
                    <i class="fas fa-angle-left"></i>
                </a>
                <a href="{{url('logout')}}" style="color:red">
                    {{awtTrans('تسجيل الخروج')}}
                    <i class="fas fa-angle-left"></i>
                </a>
            </div>
            <a href="{{url('add-estate')}}" class="continue-btn mb-5">{{awtTrans('اضافه اعلان')}}</a>
        </div>
    </div>
</section>
@endsection
