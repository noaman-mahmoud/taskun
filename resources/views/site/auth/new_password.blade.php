@extends('site.layouts.master')
@section('content')

    <section class="content">
        <!-- banner- section -->
        <div class="banner-section banner-show" style="background-image: url({{asset('website/img/banner-home.png')}});">
            <div class="container">
                <div class="info">
                    <p class="title">{{awtTrans(' تغير كلمة المرور')}}</p>
                </div>
            </div>
        </div>

        <div class="form-section">
            <div class="container">
                <form method="POST" action="{{url('post-new-password')}}" id="NewPassword" class="main-form form-horizontal"
                      autocomplete="off" novalidate>
                    @csrf

                    <div class="form-group input-text">
                        <label for="" class="label">{{awtTrans('كلمة المرور')}}</label>
                        <div class="controls">
                            <input type="password" name="password"  placeholder="{{awtTrans('كلمة المرور')}}" required data-validation-required-message="{{awtTrans('هذا الحقل مطلوب')}}" >
                        </div>
                    </div>

                    <div class="form-group input-text">
                        <label for="" class="label">{{awtTrans('تأكيد كلمة المرور')}}</label>
                        <div class="controls">
                            <input type="password" name="password_confirmation"  placeholder="{{awtTrans('تأكيد كلمة المرور')}}" required data-validation-required-message="{{awtTrans('هذا الحقل مطلوب')}}" >
                        </div>
                    </div>

                    <button class="continue-btn" type="submit">{{awtTrans('تأكيد')}}</button>
                </form>
            </div>
        </div>
    </section>

@endsection
@section('scripts')
    {!! jsValidation('Api\Auth\NewPasswordRequest', '#NewPassword') !!}
@endsection


