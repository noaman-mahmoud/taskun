@extends('site.layouts.master')

@section('content')

<section class="content orange">
    <!-- banner- section -->
    <div class="banner-section banner-show" style="background-image: url({{url('website/img/banner-home.png')}});">
        <div class="container">
            <div class="info">
                <p class="title">{{awtTrans('حواله بنكية')}}</p>
            </div>
        </div>
    </div>

    <!-- start to banck- acount  -->
    <div class="bank-account">
        <div class="container">
          @foreach($banks as $bank)
            <div class="bank-count">
                <div class="logo-banck">
                    <img src="{{$bank->image}}" alt="">
                </div>
                <div class="info">
                    <h1 class="title">{{$bank->bank_name}}</h1>
                    <p class="name-acount">{{$bank->account_name}}</p>
                    <p class="hint">{{awtTrans('رقم الحساب')}} : {{$bank->account_number}}</p>
                    <p class="hint">{{awtTrans('رقم الايبان')}} : {{$bank->iban_number}}</p>
                </div>
            </div>
          @endforeach
        </div>
    </div>

    <!--  start to form section  -->

    <div class="form-section">
        <div class="container">

            <form action="{{url('post-bank-transfer')}}" id="transfer" class="main-form" method="post" enctype="multipart/form-data">
                @csrf
                <!-- section - preview -->
                <div class="preview-section">
                    <div class="profile-img-upload main-img-ad">
                        <label class="inner">
                            <input type="file" class="d-none" name="image">
                            <img src="{{asset('website/img/picture_add.png')}}" alt=""  class="mb-0">
                        </label>
                        <span class="hint">{{awtTrans('صورة الحوالة البنكية')}}</span>
                    </div>

                </div>

                <div class="form-group input-text">
                    <label for="" class="label">{{awtTrans('اسم البنك')}}</label>
                    <input type="text" name="name" placeholder="{{awtTrans('اسم البنك')}}">
                </div>

                <div class="form-group input-text">
                    <label for="" class="label">{{awtTrans('اسم صاحب الحساب')}}</label>
                    <input type="text" name="account_owner" placeholder="{{awtTrans('اسم صاحب الحساب')}}">
                </div>

                <div class="form-group input-text">
                    <label for="" class="label">{{awtTrans('رقم الحساب')}}</label>
                    <input type="number" name="account_number" placeholder="{{awtTrans('رقم الحساب')}}" lang="en">
                </div>

                <div class="form-group input-text with-hint">
                    <label for="" class="label">{{awtTrans('المبلغ المطلوب سداده')}}</label>
                    <input type="number" name="amount" readonly value="{{ isset($price) ? $price : '' }}" lang="en">
                    <input type="hidden" name="type"   value="{{ isset($type)  ? $type  : null }}">
                    <span class="hint">{{awtTrans('ريال')}}</span>
                </div>

                <button type="submit" class="continue-btn">{{awtTrans('تأكيد')}}</button>
            </form>

        </div>
    </div>
</section>

@endsection



@section('scripts')
    {!! jsValidation('Api\User\BankTransfers', '#transfer') !!}
    <script>
        $(document).on('change', '.profile-img-upload input', function (event) {
            if(event.target.files.length > 0) {
                $(this).siblings('img').attr('src', URL.createObjectURL(event.target.files[0]));
                $(this).siblings('img').attr('class','img-view')

            } else {
                $(this).siblings('img').attr('src','img/picture_add.png');
                $(this).siblings('img').attr('class','')
            }
        });

        $(document).on("click", ".remove", function () {
            $(this).parent().find(".prev").remove()
            $("#image").val("")
            $(this).remove()
        });
    </script>
@endsection
