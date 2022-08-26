@extends('site.layouts.master')

@section('content')
<section class="content">
    <!-- banner- section -->
    <div class="banner-section banner-show" style="background-image: url({{url('website/img/banner-home.png')}});">
        <div class="container">
            <div class="info">
                <p class="title">{{awtTrans('الحسابات البنكية')}}</p>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="account-section flex-wrap mb-5">
           @foreach($banks as $bank)
            <div class="acount-title mb-5" style="flex-basis: 40% ">
                <img src="{{$bank->image}}" alt="">
                <div class="img-info">
                    <p class="title">{{$bank->bank_name}}</p>
                    <p class="title">{{$bank->account_name}}</p>
                    <p class="hint">{{$bank->bank_name}}</p>
                    <p class="hint">{{$bank->iban_number}}</p>
                </div>
            </div>
           @endforeach
        </div>
    </div>
</section>
@endsection
