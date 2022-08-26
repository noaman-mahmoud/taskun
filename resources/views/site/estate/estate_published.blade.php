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
                {{awtTrans('تقرير الذمه الماليه')}}
            </div>
            <div class="pr-bar">
                <span class="hint">5/5</span>
                <div role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="50" style="--value:100">
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="img-box-statement">
            <img src="{{asset('website/img/undraw_best_place_r685.png')}}" class="img-und-2" alt="">
            <p class="title">{{awtTrans('تم أضافه عقارك بنجاح')}}</p>
            <a href="{{url('account')}}" class="continue-btn">{{awtTrans('عوده لحسابك')}}</a>
        </div>
    </div>
</section>
@endsection
@section('scripts')
    <script>
        history.pushState(null, null, location.href);
        window.onpopstate = function () {
            history.go(1);
        };
    </script>
@endsection
