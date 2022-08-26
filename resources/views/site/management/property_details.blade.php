@extends('site.layouts.master')
@section('content')
<section class="content">
    <!-- start to room-banner  -->
    <div class="room-banner section-banner-slide">
        <div class="container">

            <div class="owl-carousel owl-theme banner-slider">
                <div class="inner item">
                    <img src="{{$property['image']}}" alt="" class="img">
                </div>
            </div>

        </div>
    </div>

    <div class="container">

        <div class="house-title-info">
            <p class="head-info">{{$property['name']}}</p>
            <div class="location-info">
                <p class="hint-2 cl-green">
                    <img src="{{asset('website/img/location-2.png')}}" alt="">
                      {{$property['address']}}
                </p>
            </div>
        </div>

        <div class="title-show cl-green">
            <span class="bg-green"></span>
            {{awtTrans('تفاصيل العقار')}}
        </div>

    </div>
    <!-- start to info-Ad -->
    <div class="info-Ad">

        <div class="info-product">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-6 col-sm-12">
                        <div class="box mrg-box">
                            <img src="{{asset('website/img/bulding-img.png')}}" alt="">
                            <p class="hint">{{awtTrans('نوع العقار')}}</p>
                            <p class="hint-2 cl-green">{{$property['estate_type']}}</p>
                        </div>
                    </div>

                    <div class="col-12 col-lg-6 col-sm-12">
                        <div class="box">
                            <img src="{{asset('website/img/work-tools.png')}}" alt="">
                            <p class="hint">{{awtTrans('عدد الأدوار')}}</p>
                            <p class="hint-2 cl-green">{{$property['number_roles']}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="info-product info-with-bgc">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-6 col-sm-12">
                        <div class="box mrg-box">
                            <img src="{{asset('website/img/sketch.png')}}" alt="">
                            <p class="hint">{{awtTrans('نوع السكن')}}</p>
                            <p class="hint-2 cl-green">{{$property['housingType']}}</p>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 col-sm-12">
                        <div class="box">
                            <img src="{{asset('website/img/length.png')}}" alt="">
                            <p class="hint">{{awtTrans('عدد الوحدات')}}</p>
                            <p class="hint-2 cl-green">{{$property['units_count']}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="container">
        <div class="title-show cl-green">
            <span class="bg-green"></span>
            {{awtTrans('الشقق المضافه')}}
        </div>
    </div>

    <div class="house-room-info">
        <div class="container">
            <div class="row">
              @foreach($property['units'] as $unit)
                <div class="col-12 col-lg-3 col-md-6 col-sm-12">
                    <a href="{{url('unit-details/'.$unit['id'].'/'.$property['id'])}}" class="item">
                        <p class="title">{{awtTrans('الدور')}} {{$unit['role']}}</p>
                        <p class="disc">{{$unit['tenant_name']}}</p>
                        <p class="hint">{{$unit['date']}}</p>
                    </a>
                </div>
              @endforeach
            </div>
            <a href="{{url('add-unit/'.$property['id'])}}" class="phone-cal-btn green">
                {{awtTrans('أضافه وحده سكنية')}}
            </a>
        </div>
    </div>
</section>
@endsection
