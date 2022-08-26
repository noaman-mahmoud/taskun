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
                {{awtTrans('وسائل التواصل')}}
            </div>
            <div class="pr-bar">
                <span class="hint">3/5</span>
                <div role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="50" style="--value:60">
                </div>
            </div>
        </div>
    </div>

    <div class="form-section">
        <div class="container">

            <form action="{{url('post-estate-contacts')}}" method="post" class="main-form" id="EstateContacts">
                @csrf
                <div class="form-group input-text">
                    <label for="" class="label">{{awtTrans('رقم الواتس اب')}}</label>
                    <input type="number" placeholder="{{awtTrans('رقم الواتس اب')}}" name="whatsapp" lang="en">
                </div>

                <div class="form-group input-text">
                    <label for="" class="label">{{awtTrans('رقم للأتصال')}}</label>
                    <input type="number" placeholder="0540000000" name="phones[]" lang="en">

                </div>

                <div class="form-group input-text added-another-input">
                    <input type="number" class="addphonenum" name="phones[]" placeholder="{{awtTrans('اضافه رقم أخر')}}" lang="en">
                </div>

                @if(Auth::user()->type != 'owner')

                   <div class="media-info">
                    <p class="title">
                        {{awtTrans('معلومات صاحب العقار')}}
                        <span>{{awtTrans('( تضاف أن وجدت )')}}</span>
                    <p class="info">{{awtTrans('هذه المعلومات تظهر لك فقط')}}</p>
                    </p>
                </div>

                   <div class="form-group input-text">
                     <label for="" class="label">{{awtTrans('اسم صاحب العقار')}}</label>
                     <input type="text" placeholder="{{awtTrans('اسم صاحب العقار')}}" name="username">
                   </div>

                   <div class="form-group input-text">
                     <label for="" class="label">{{awtTrans('جوال صاحب العقار')}}</label>
                     <input type="text" placeholder="{{awtTrans('جوال صاحب العقار')}}" name="user_phone">
                   </div>

                   <div class="form-group input-text">
                     <label for="" class="label">{{awtTrans('واتساب صاحب العقار')}}</label>
                     <input type="text" placeholder="{{awtTrans('واتساب صاحب العقار')}}" name="user_whatsapp">
                   </div>
                @endif

                <button type="submit" class="continue-btn">{{awtTrans('اكمال')}}</button>
            </form>

        </div>
    </div>
</section>
@endsection
@section('scripts')
    {!! jsValidation('Api\Estate\EstateContacts', '#EstateContacts') !!}
@endsection
