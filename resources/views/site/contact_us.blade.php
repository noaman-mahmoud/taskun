@extends('site.layouts.master')

@section('content')
    <section class="content">
        <!-- banner- section -->
        <div class="banner-section banner-show" style="background-image: url({{url('website/img/banner-home.png')}});">
            <div class="container">
                <div class="info">
                    <p class="title">{{awtTrans('تواصل معنا')}}</p>
                </div>
            </div>
        </div>

        <div class="section-social">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="item">
                            <h1 class="title">{{awtTrans('وسائل التواصل')}}</h1>
                            <div class="social-box">
                                <p class="icon">
                                    <img src="{{url('website/img/watts-img.png')}}" alt="">
                                    <span>{{$data['phone']}}</span>
                                </p>
                                <p class="icon">
                                    <img src="{{url('website/img/email-img.png')}}" alt="">
                                    <span>{{$data['email']}}</span>
                                </p>
                                <p class="icon">
                                    <img src="{{url('website/img/wats-img.png')}}" alt="">
                                    <span>{{$data['whatsapp']}}</span>

                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="item">
                            <h1 class="title">{{awtTrans('وسائل التواصل الاجتماعي')}}</h1>
                            <div class="social-box">
                              @foreach($data['socials'] as $social)
                                <p class="icon">
                                    <img src="{{$social['icon']}}" alt="">
                                    <span>{{$social['link']}}</span>
                                </p>
                              @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
