@extends('site.layouts.master')

@section('content')
    <section class="content">
        <div class="banner-section" style="background-image: url({{asset('website/img/banner-home.png')}});">
            <div class="container">
                <div class="info">
                    <p class="title">
                        {{awtTrans('إبحث عن عقارات للبيع و للايجار في السعودية')}}
                    </p>
                    <div class="select-section">
                        <form action="{{url('post-search')}}" method="post" class="filter">
                            @csrf
                            <div class="top">
                                <select name="category_id" id="" class="map map-2 select-plugin">
                                  @foreach($categories as $category)
                                    <option value="{{$category->id}}">
                                        {{$category->name}}
                                    </option>
                                  @endforeach
                                </select>
                                <select name="estate_category_id" id="" class="map select-plugin">
                                  @foreach($estateCategories as $estateCategory)
                                    <option value="{{$estateCategory->id}}">
                                        {{$estateCategory->name}}
                                    </option>
                                  @endforeach
                                </select>
                                <div class="nav-text">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <input type="text" name="address" placeholder="{{awtTrans('المدينة أو الحي أو إسم الشارع')}}">
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="theme-btn bg-orange">{{awtTrans('ابحث')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <img src="{{asset('website/img/banner-logo.png')}}" class="banner-logo" alt="">
        </div>

        <!-- start to section category -->

        <div class="category-item">
            <div class="container">
                <div class="title-show cl-blue">
                    <span class="bg-blue"></span>
                    {{awtTrans('العروض المباشره')}}
                </div>

                <div class="row">
                   @foreach($shows as $show)
                    <div class="col-12 col-lg-4 col-md-6 col-sm-12">
                        <a href="{{url('estate-details/'.$show['id'])}}" class="category-box">
                            <img src="{{$show['image']}}" alt="" class="categor-img">
                            <div class="info">
                                <h1 class="title">{{$show['title']}}</h1>
                                <p class="salary">{{$show['price']}}</p>
                                <p class="disc">{{$show['address']}}</p>
                                <div class="view">
                                    <p class="icon-view">
                                        <span>
                                            <i class="far fa-thumbs-up"></i>
                                            {{$show['likes']}}
                                        </span>
                                        <span>
                                            <i class="far fa-eye"></i>
                                            {{$show['views']}}
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                   @endforeach
                </div>
                <a href="{{url('live-shows')}}" class="theme-btn bg-blue">
                    {{awtTrans('عرض المزيد')}}
                </a>
            </div>
        </div>

        <!-- start to section tabs -->

        <div class="tabs category-item">
            <div class="container">
                <div class="title-show cl-orange">
                    <span class="bg-orange"></span>
                    {{awtTrans('وسطاء عقاريون')}}
                </div>

                <ul class="nav nav-pills tab-list" id="pills-tab" role="tablist">
                    <li class="nav-item active">
                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab"
                           aria-controls="pills-home" aria-selected="true">
                            {{awtTrans('مكاتب عقاريه')}}
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile"
                           role="tab" aria-controls="pills-profile" aria-selected="false">
                            {{awtTrans('مسوق عقاري')}}
                        </a>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <!-- first- tab -->

                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div class="row">
                          @foreach($offices as $office)
                            <div class="col-12 col-lg-4 col-md-6 col-sm-12">
                                <a href="{{url('broker-details/'.$office['uuid'])}}" class="category-box">
                                    <img src="{{$office['avatar']}}" alt="" class="categor-img">
                                    <div class="info">
                                        <h1 class="title">{{$office['name']}}</h1>
                                        <p class="salary cl-orange">
                                            <i class="fas fa-bullhorn"></i>
                                            {{awtTrans('عدد الأعلانات')}}

                                            {{$office['count']}}
                                        </p>
                                        <p class="disc">{{$office['address']}}</p>
                                        <div class="view">
                                        </div>
                                    </div>
                                </a>
                            </div>
                          @endforeach
                        </div>

                        <a href="{{url('brokers')}}" class="theme-btn bg-orange mrg-btn">
                            {{awtTrans('عرض المزيد')}}
                        </a>
                    </div>

                    <!-- sec-tab -->

                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="row">
                          @foreach($marketers as $marketer)
                             <div class="col-12 col-lg-4 col-md-6 col-sm-12">
                                    <a href="{{url('broker-details/'.$marketer['uuid'])}}" class="category-box">
                                        <img src="{{$marketer['avatar']}}" alt="" class="categor-img">
                                        <div class="info">
                                            <h1 class="title">{{$marketer['name']}}</h1>
                                            <p class="salary cl-orange">
                                                <i class="fas fa-bullhorn"></i>
                                                {{awtTrans('عدد الأعلانات')}}

                                                {{$marketer['count']}}
                                            </p>
                                            <p class="disc">{{$marketer['address']}}</p>
                                            <div class="view">
                                              {{-- <p class="hint">يبعد 10 كيلو</p>--}}
                                            </div>
                                        </div>
                                    </a>
                                </div>
                          @endforeach
                        </div>

                        <a href="{{url('brokers')}}" class="theme-btn bg-blue">
                            {{awtTrans('عرض المزيد')}}
                        </a>
                    </div>

                </div>
            </div>
        </div>

        <div class="add-product category-item">
            <div class="container">
                <div class="title-show cl-green mb-5">
                    <span class="bg-green"></span>
                    {{awtTrans('إدارة ملاك')}}
                </div>
                <div class="product-info">
                    <img src="{{asset('website/img/add-product-img.png')}}" alt="">
                    <p class="text">{{awtTrans('أضافه عقاراتك')}}</p>
                    <p class="hint cl-green">
                        {{awtTrans('يمكنك أضافه عقاراتك ومتابعه الشقق ودفع الإيجار عبر جوالك')}}
                    </p>
                    <a href="{{url('add-property')}}" class="theme-btn bg-green mrg-btn">
                        {{awtTrans('أضف عقارك')}}
                    </a>
                </div>
            </div>
        </div>
        <div class="banner-store">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-6 col-sm-12">
                        <div class="info">
                            <h1 class="title">
                                {{awtTrans('يمكنك تحميل تطبيقاتنا على جوالك')}}
                            </h1>
                            <div class="imgs-store">
                                <img src="{{asset('website/img/google-play-store-apple.png')}}" alt="">
                                <img src="{{asset('website/img/google-play-store.png')}}" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 col-sm-12">
                        <div class="store-img">
                            <img src="{{asset('website/img/img-store-1.png')}}" alt="" class="store-1">
                            <img src="{{asset('website/img/img-storee-2.png')}}" class="store-2" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- connect-us section  -->
        <div class="connect-us">
            <div class="container">
                <div class="info">
                    <p class="title">{{awtTrans('تواصل معنا')}}</p>
                </div>
                <form action="{{url('contact')}}" id="contact" method="post" class="form-section">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-6 col-sm-12">
                            <div class="input">
                                <label class="label">{{awtTrans('رقم الجوال')}}</label>
                                <input type="number" name="phone" lang="en" placeholder="{{awtTrans('برجاء ادخال رقم الجوال')}}">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-sm-12">
                            <div class="input">
                                <label class="label">{{awtTrans('البريد الالكتروني')}}</label>
                                <input type="email" name="email" placeholder="{{awtTrans('برجاء ادخال البريد الالكتروني')}}">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="text-area">
                                <label class="label">{{awtTrans('رسالتك')}}</label>
                                <textarea name="message" placeholder="{{awtTrans('برجاء ادخال رسالتك')}}"></textarea>
                            </div>
                        </div>
                        <button type="submit" class="submit-btn mrg-btn bg-orange">{{awtTrans('ارسال')}}</button>
                    </div>
                </form>
            </div>
        </div>

    </section>
@endsection

@section('scripts')
    {!! jsValidation('Api\Complaints\ContactRequest', '#contact') !!}
@endsection
