@extends('site.layouts.master')
@section('content')
<section class="content">
    <!-- banner- section -->
    <div class="banner-section banner-show" style="background-image: url({{url('website/img/banner-home.png')}});">
        <div class="container">
            <div class="info">
                <p class="title">{{awtTrans('كود التفعيل')}}</p>
            </div>
        </div>
    </div>

    <div class="form-section code-number-form">
        <div class="container">

            <form action="{{url('post-activate-code')}}" class="main-form form-code-num" method="post" >
                @csrf
                <div class="form-group">
                    <label for="" class="label">{{awtTrans('كود التحقق')}}</label>
                    <div class="code-confirmation">
                        <input type="text" name="code[]" placeholder="0" maxlength="1" class="confirm-input" required lang="en"/>
                        <input type="text" name="code[]" placeholder="0" maxlength="1" class="confirm-input" required lang="en"/>
                        <input type="text" name="code[]" placeholder="0" maxlength="1" class="confirm-input" required lang="en"/>
                        <input type="text" name="code[]" placeholder="0" maxlength="1" class="confirm-input" required lang="en"/>
                    </div>

                </div>

                <a href="{{url('resend-code')}}" class="register-now cl-tr-blue mb-4 d-block">
                    {{awtTrans('لم يصلني الكود')}}
                </a>
                <button type="submit" class="continue-btn sabmit-btn">{{awtTrans('تأكيد')}}</button>
            </form>

        </div>
    </div>
</section>
@endsection
@section('scripts')

@endsection
