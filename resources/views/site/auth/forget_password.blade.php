@extends('site.layouts.master')
@section('content')

    <section class="content">
        <!-- banner- section -->
        <div class="banner-section banner-show" style="background-image: url({{asset('website/img/banner-home.png')}});">
            <div class="container">
                <div class="info">
                    <p class="title">
                        {{awtTrans('اعادة تعين كلمة المرور')}}
                    </p>
                </div>
            </div>
        </div>

        <div class="form-section">
            <div class="container">
                <form method="POST" action="{{url('post-forget-password')}}" id="forget" class="main-form form-horizontal"
                      autocomplete="off" novalidate>
                    @csrf

                    <div class="form-group input-text">
                        <label for="" class="label">{{awtTrans('رقم الجوال')}}</label>
                        <div class="controls">
                            <input type="text" name="phone"  placeholder="{{awtTrans('رقم الجوال')}}" required data-validation-required-message="{{awtTrans('هذا الحقل مطلوب')}}" >
                        </div>
                    </div>

                    <button class="continue-btn" type="submit">{{awtTrans('دخول')}}</button>
                    <p class="register-now">{{awtTrans('ليس لديك حساب ؟')}}
                        <a href="{{url('sign-up')}}">{{awtTrans('سجل الان')}}</a>
                    </p>
                </form>
            </div>
        </div>
    </section>

@endsection
@section('scripts')
    {!! jsValidation('Api\Auth\ForgetPasswordRequest', '#forget') !!}
@endsection


