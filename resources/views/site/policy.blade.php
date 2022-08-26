@extends('site.layouts.master')

@section('content')
    <section class="content">
        <!-- banner- section -->
        <div class="banner-section banner-show" style="background-image: url({{url('website/img/banner-home.png')}});">
            <div class="container">
                <div class="info">
                    <p class="title">{{awtTrans('سياسة الاستخدام')}}</p>
                </div>
            </div>
        </div>

        <div class="section-about">
            <div class="container">
                <div class="text">
                    <p class="disc">
                        {!! $data !!}
                    </p>
                </div>
            </div>
        </div>

    </section>
@endsection
