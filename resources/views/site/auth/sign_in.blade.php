@extends('site.layouts.master')
@section('content')

<section class="content">
    <!-- banner- section -->
    <div class="banner-section banner-show" style="background-image: url({{asset('website/img/banner-home.png')}});">
        <div class="container">
            <div class="info">
                <p class="title">{{awtTrans('تسجيل دخول')}}</p>
            </div>
        </div>
    </div>

    <div class="form-section">
        <div class="container">
            <form method="POST" action="{{url('post-sign-in')}}" id="sign" class="main-form form-horizontal"
                  autocomplete="off" novalidate>
                @csrf
                <div class="form-group input-text">
                    <label for="" class="label">{{awtTrans('رقم الجوال')}}</label>
                    <div class="controls">
                        <input type="text" name="phone"  placeholder="{{awtTrans('رقم الجوال')}}" lang="en"
                               required data-validation-required-message="{{awtTrans('هذا الحقل مطلوب')}}" >
                    </div>
                </div>

                <div class="form-group input-text">
                    <label for="" class="label">{{awtTrans('كلمة المرور')}}</label>
                    <div class="controls">
                        <input type="password" name="password" placeholder="{{awtTrans('كلمة المرور')}}"
                             required data-validation-required-message="{{awtTrans('هذا الحقل مطلوب')}}" >
                    </div>
                </div>

                <input type="hidden" name="device_type" value="web">
                <input type="hidden" name="device_id" value="web-222">

                <a href="{{url('forget-password')}}" class="forget-password">
                    {{awtTrans('هل نسيت كلمة المرور ؟')}}
                </a>

                <button class="continue-btn submit_button" type="submit">{{awtTrans('دخول')}}</button>

                <p href="" class="register-now">{{awtTrans('ليس لديك حساب ؟')}}
                    <a href="{{url('sign-up')}}">
                        {{awtTrans('سجل الان')}}
                    </a>
                </p>
            </form>
        </div>
    </div>
</section>

@endsection
@section('scripts')
    {!! jsValidation('Api\Auth\SignInRequest', '#sign') !!}
@endsection


