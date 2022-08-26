@extends('site.layouts.master')

@section('content')

<section class="content orange">

    <!-- banner- section -->
    <div class="banner-section banner-show" style="background-image: url({{url('website/img/banner-home.png')}});">
        <div class="container">
            <div class="info">
                <p class="title">{{awtTrans('تأكيد ارسال الحوالة')}}</p>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="img-box-statement">
            <img src="{{url('website/img/undraw_done_a34v.png')}}" class="done-img" alt="">
            <p class="title">{{awtTrans('تم دفع العموله بنجاح')}}</p>
            <p class="hint">{{awtTrans('نشكرك علي امانتك وألتزامك بالذمه الماليه')}}</p>
            <a href="{{url('account')}}" class="continue-btn">{{awtTrans('عوده لحسابك')}}</a>
        </div>

    </div>
</section>

@endsection
