@extends('site.layouts.master')
@section('content')
<section class="content orange">
    <!-- banner- section -->
    <div class="banner-section banner-show" style="background-image: url({{url('website/img/banner-home.png')}});">
        <div class="container">
            <div class="info">
                <p class="title">{{awtTrans('اضافه اعلان')}}</p>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="progress-form">
            <div class="title-show cl-blue">
                <span class="bg-blue"></span>
                {{awtTrans('تقرير الذمة المالية')}}
            </div>
            <div class="pr-bar">
                <span class="hint">4/5</span>
                <div role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="50" style="--value:80">
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="img-box-statement">
            <img src="{{url('website/img/undraw_Mobile_pay_re_sjb8.png')}}" alt="">
            <p class="title">{{awtTrans('تعهد ذمه ماليه بدفع العموله علي عمليات البيع')}}</p>
            <p class="hint">{{awtTrans('أتعهد أنا صاحب الأعلان امام الله بدفع العموله')}}</p>
            <a href="{{url('confirm-estate')}}" class="continue-btn">{{awtTrans('اكمال')}}</a>
            <a href="{{url('/')}}" class="continue-btn cancel-btn cancel-bg">{{awtTrans('الغاء')}}</a>
        </div>

    </div>
</section>
@endsection
