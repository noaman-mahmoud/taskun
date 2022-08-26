@extends('site.layouts.master')

@section('content')
    <section class="content orange">
        <!-- start to room-banner  -->
        <div class="room-banner section-banner-slide">
            <div class="container">
                <div class="owl-carousel owl-theme banner-slider banner-dots">
                    <div class="inner item">
                        <img src="{{$data['avatar']}}" alt="" class="img">
                        <div class="icons house-info-iceon">
                            <span class="hint-icon">{{$data['created']}}</span>
                            <div class="parent-iceon">
                                <a href="" class="icon"><i class="fas fa-share-alt"></i></a>
{{--                                <a href="" class="icon fave"><i class="fas fa-heart"></i></a>--}}
                            </div>
                        </div>
                    </div>
                </div>
                {{--            <p class="icon-view">--}}
                {{--                <span class="like">--}}
                {{--                    <i class="far fa-thumbs-up"></i>--}}
                {{--                    <span class="add-like">500</span>--}}
                {{--                </span>--}}
                {{--                <span>--}}
                {{--                    <i class="far fa-eye"></i>--}}
                {{--                    500--}}
                {{--                </span>--}}
                {{--            </p>--}}

            </div>
        </div>

        <div class="container">

            <div class="house-title-info">
                <div class="title-info-btn">
                    <p class="head-info">{{$data['name']}}</p>
                    <button type="button" href="{{$data['url']}}" class="link-info clipboard">
                        <img src="{{asset('website/img/Icon metro-attachment.png')}}" alt="Link">
                        {{awtTrans('نسخ الرابط')}}
                        <span class="hint-clipboard">copied</span>
                    </button>
                    <button type="button" href="" class="link-info" data-toggle="modal" data-target="#exampleModalCenter">
                        <img src="{{asset('website/img/Icon metro-qrcode.png')}}" alt="QR CODE">
                        {{awtTrans('QR CODE')}}
                    </button>
                </div>
                <div class="location-info location-resp">
                    <p class="hint">
                        <img src="{{asset('website/img/orange-cityscape.png')}}" alt="">
                        {{$data['city']}}
                    </p>
                    <p class="hint-2">
                        <img src="{{asset('website/img/orange-location.png')}}" alt="">
                        {{$data['address']}}
                    </p>
                    <p class="hint-2 cl-orange">
                        <img src="{{asset('website/img/megaphone.png')}}" alt="">
                        {{awtTrans('عدد الأعلانات')}}

                           {{$data['estates_count']}}

                        {{awtTrans('أعلان')}}
                    </p>
                    <a href="https://www.google.com/maps/search/?api=1&query={{$data['lat']}},{{$data['lng']}}" target="_blanck" class="hint-info">
                        <img src="{{asset('website/img/map-2.png')}}" alt="{{awtTrans('عرض الموقع علي الخريطة')}}">
                        {{awtTrans('عرض الموقع علي الخريطة')}}
                    </a>
                </div>
            </div>

            <div class="title-show cl-blue">
                <span class="bg-blue"></span>
                {{awtTrans('تفاصيل المكتب')}}
            </div>

        </div>

        <!-- Modal -->
        <div class="modal fade qr-modal" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img src="{{$data['qr']}}" alt="">

                    </div>
                    <div class="modal-footer">
                        <a href="{{$data['qr']}}" class="download-img" download="{{$data['name']}}.png">
                            {{awtTrans('حفظ')}}
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- start to info-Ad -->
        <div class="info-Ad">

            <div class="info-product info-with-bgc">
                <div class="container">
                    <div class="row">

                        <div class="col-12 col-lg-6 col-sm-12">
                            <div class="box mrg-box">
                                <img src="{{asset('website/img/sketch.png')}}" alt="">
                                <p class="hint">{{awtTrans('رقم الجوال')}}</p>
                                <p class="hint-2">{{$data['phone']}}</p>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 col-sm-12">
                            <div class="box">
                                <img src="{{asset('website/img/length.png')}}" alt="">
                                <p class="hint">{{awtTrans('نوع الأعلانات')}}</p>
                                <p class="hint-2">{{$data['estate_type']}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if(!empty($data['estates']))
            <div class="product-for-sell">
                <div class="container">
                    <div class="offer-btns">
                        <div class="title-show cl-blue">
                            <span class="bg-blue"></span>
                            {{awtTrans('العروض')}}
                        </div>
                        <a href="{{url('broker-estates/'.$data['uuid'])}}" class="link-offer">
                            {{awtTrans('الدخول إلي العروض')}}
                        </a>
                    </div>
                    <div class="row">
                        @foreach($data['estates'] as $estate)
                            <div class="col-12 col-lg-4 col-xl-3 col-md-6 col-sm-12">
                                <a href="{{url('estate-details/'.$estate['id'])}}" class="category-box">
                                    <img src="{{$estate['image']}}" alt="" class="categor-img">
                                    <div class="info">
                                        <h1 class="title">{{$estate['title']}}</h1>
                                        <p class="salary cl-orange">{{ $estate['price'] }}</p>
                                        <p class="disc">{{$estate['address']}}</p>
                                    </div>
                                    <p class="product-hint orange-hint-product">
                                        {{$estate['type']}}
                                    </p>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
        <div class="container">
            <div class="contact-btns">
                <a href="tel:{{$data['phone']}}" class="phone-ct active btn-wats" data-toggle="dropdown">
                    <i class="fas fa-phone-alt"></i>
                    {{awtTrans('الأتصال علي الهاتف')}}
                    <div class="dropdown-menu">
                        <span> {{awtTrans('رقم الجوال')}} : <span class="hint">{{$data['phone']}}</span> </span>
                    </div>
                </a>
                @isset($data['whatsapp'])
                    <a href="https://api.whatsapp.com/send?phone={{$data['whatsapp']}}&text=هلا" class="watts-ct">
                        <img src="{{asset('website/img/whatsapp (3).png')}}" alt="">
                        {{awtTrans('عبر الواتساب')}}
                    </a>
                @endisset
            </div>

        </div>
    </section>

@endsection

@section('scripts')
@endsection
