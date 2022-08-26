@extends('site.layouts.master')

@section('meta')
    <meta property="og:title" content="{{$estate['title']}}" />
    <meta property="og:description" content="{{$estate['description']}}" />
    <meta property="og:site_name" content="{{$estate['title']}}" />
@endsection

@section('content')
    <section class="content">

        <div class="room-banner section-banner-slide">
            <div class="container">
                <div class="owl-carousel owl-theme banner-slider">
                    @foreach($estate['images'] as $image)
                        <div class="inner item">
                            <img src="{{$image}}" alt="" class="img">
                        </div>
                    @endforeach
                </div>
                <p class="icon-view">
                <span class="like">
                    <i class="far fa-thumbs-up"></i>
                    <span class="add-like">{{$estate['likes']}}</span>
                </span>
                    <span> <i class="far fa-eye"></i>
                    {{$estate['views']}}
                </span>
                </p>

                <div class="icons">
                    <a href="" class="icon">
                        <!-- ShareThis BEGIN -->
                        <i class="">
                            <div class="sharethis-inline-share-buttons"></div>
                        </i>
                        <!-- ShareThis END -->
                    </a>
                    @auth
                        <a href="" class="icon fave">
                            <i class="fas fa-heart favorite {{$estate['is_favorite'] == 1  ? 'active' : ''}}"
                               data-id="{{$estate['id']}}">
                            </i>
                        </a>
                    @endauth
                </div>
            </div>

        </div>

        <div class="container">

            <div class="house-title-info">
                <p class="head-info"></p> {{$estate['title']}}
                <div class="location-info">
                    <p class="hint">
                        <img src="{{asset('website/img/cityscape.png')}}" alt="">
                        {{$estate['city']}}
                    </p>
                    <p class="hint-2">
                        <img src="{{asset('website/img/location (2).png')}}" alt="">
                        {{$estate['address']}}
                    </p>
                    <a href="https://www.google.com/maps/search/?api=1&query={{$estate['lat']}},{{$estate['lng']}}" target="_blanck" class="hint-info">
                        <img src="{{asset('website/img/map-2.png')}}" alt="">
                        {{awtTrans('عرض الموقع علي الخريطة')}}
                    </a>
                </div>
            </div>

            <div class="title-show cl-blue">
                <span class="bg-blue"></span>
                {{awtTrans('تفاصيل الاعلان')}}
            </div>

        </div>
        <!-- start to info-Ad -->
        <div class="info-Ad">
            <div class="info-product">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-6 col-sm-12">
                            <div class="box mrg-box">
                                <img src="{{url('website/img/bulding-img.png')}}" alt="">
                                <p class="hint">{{awtTrans('نوع العقار')}}</p>
                                <p class="hint-2">{{$Estate->category->name}}</p>
                            </div>
                        </div>

                        <div class="col-12 col-lg-6 col-sm-12">
                            <div class="box mrg-box">
                                <img src="{{url('website/img/bulding-img.png')}}" alt="">
                                <p class="hint">{{awtTrans('فئة العقار')}}</p>
                                <p class="hint-2">{{$Estate->estateCategory->name}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="info-product">
                <div class="container">
                    <div class="row">
                        @foreach($estate['features'] as $feature)
                            <div class="col-12 col-lg-6 col-sm-12" style="margin-bottom: 15px;">
                                <div class="box mrg-box">
                                    <img src="{{$feature['image']}}" alt="">
                                    <p class="hint">{{$feature['name']}}</p>
                                    <p class="hint-2">{{$feature['value']}}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @isset($estate['description'])
            <div class="container">
                <div class="disc-info">
                    <p class="title">{{awtTrans('الوصف')}}</p>
                    <p class="hint">{{$estate['description']}}</p>
                </div>
            </div>
        @endisset
        <div class="link-info-Ad">
            <div class="container">
                <div class="title-show cl-blue mb-5">
                    <span class="bg-blue"></span>
                    {{awtTrans('تفاصيل أخري')}}
                </div>
                <div class="row justify-content-center">
                    @foreach($estate['additions'] as $addition)
                        <div class="col-4 col-md-2">
                            <a href="#" class="item">
                                <img src="{{$addition['image']}}" alt="">
                                <p class="hint">{{$addition['name']}}</p>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="product-for-sell">
            <div class="container">
                <div class="title-show cl-blue">
                    <span class="bg-blue"></span>
                    {{awtTrans('عقارات اخري لنفس المالك')}}
                </div>
                <div class="row">
                    @foreach($estates as $value)
                        <div class="col-12 col-lg-4 col-xl-3 col-md-6 col-sm-12">
                            <div class="category-box">
                                <img src="{{$value->estateImage->image}}" alt="" class="categor-img">
                                <div class="info">
                                    <h1 class="title">{{$value->title}}</h1>
                                    <p class="salary">{{isset($value->price) ? $value->price  : ''}}</p>
                                    <p class="disc">{{$value->address}}</p>
                                    <div class="view">
                                        {{--  <p class="hint">يبعد 10 كيلو</p>--}}
                                        <p class="icon-view">
                                    <span>
                                        <i class="far fa-thumbs-up"></i>
                                        {{isset($value->likes) ? $value->likes->sum('count') : 0}}
                                    </span>
                                            <span>
                                        <i class="far fa-eye"></i>
                                        {{$value->views}}
                                    </span>
                                        </p>
                                    </div>
                                </div>
                                <p class="product-hint">
                                    {{trans('apis.'.$value->type)}}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="container">
                <div class="contact-btns">
                  @if(!empty($estate['phones']))
                    <a href="tel:" class="phone-ct active btn-wats" data-toggle="dropdown">
                        <i class="fas fa-phone-alt"></i>
                        {{awtTrans('الأتصال علي الهاتف')}}
                        <div class="dropdown-menu">
                          @foreach($estate['phones'] as $phone)
                            <span> {{awtTrans('رقم الجوال')}} :
                                <span class="hint">
                                  {{$phone}}
                                </span>
                            </span>
                          @endforeach
                        </div>
                    </a>
                    @endif
{{--                    <a href="tel:{{$estate['phone']}}" class="phone-ct active">--}}
{{--                        <i class="fas fa-phone-alt"></i>--}}
{{--                        {{awtTrans('الأتصال علي الهاتف')}}--}}
{{--                    </a>--}}
                    @if(isset($estate['whatsapp']))
                    <a href="https://wa.me/{{$estate['whatsapp']}}" class="watts-ct" target="_blank">
                        <img src="{{asset('website/img/whatsapp (3).png')}}" alt="">
                        {{awtTrans('عبر الواتساب')}}
                    </a>
                   @endif
                </div>

        </div>
    </section>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.all.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.favorite').on('click', function(){
                var estate = $(this).data('id')
                $.ajax({
                    url: '{{url('favorite')}}',
                    type: 'post',
                    data: { "_token": "{{ csrf_token() }}" , 'estate_id': estate},
                    success: function(response){
                        Swal.fire({
                            icon: 'success',
                            title: '{{trans('site.favorite')}}',
                            text: response['msg'],
                            timer: 2500,
                        })
                    },
                })
            });
        });
    </script>
@endsection

