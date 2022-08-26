@extends('site.layouts.master')
@section('content')
<section class="content">
    <!-- banner- section -->
    <div class="banner-section banner-show" style="background-image: url({{url('website/img/banner-home.png')}});">
        <div class="container">
            <div class="info">
                <p class="title">{{awtTrans('إدارة ملاك')}}</p>
            </div>
        </div>
    </div>
    <div class="add-product category-item">
        <div class="container">
            <div class="product-info">
                <img src="{{asset('website/img/add-product-img.png')}}" alt="">
                <p class="text">{{awtTrans('لم يتم أضافه أي عقارات بعد')}}</p>
                <p class="hint cl-green">
                    {{awtTrans('يمكنك أضافه عقاراتك ومتابعه الشقق ودفع الإيجار عبر جوالك')}}
                </p>
                <a href="{{url('add-property')}}" class="theme-btn bg-green mrg-btn">
                    {{awtTrans('أضف عقارك')}}
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
