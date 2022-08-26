@extends('site.layouts.master')

@section('content')

<section class="content">

    <!-- banner- section -->
    <div class="banner-section banner-show" style="background-image: url({{url('website/img/banner-home.png')}});">
        <div class="container">
            <div class="info">
                <p class="title">{{awtTrans('حساب قيمة العمولة')}}</p>
            </div>
        </div>
    </div>

    <div class="form-section">
        <div class="container">
            <div class="img-box-statement">
                <img src="{{url('website/img/undraw_statistic_chart_38b6.png')}}" alt="">
            </div>

            <form action="{{url('transfer')}}" class="main-form" method="post">
                 @csrf

                <div class="form-group input-text with-cl-blue">
                    <label for="" class="label cl-blue">{{awtTrans('مبلغ العقار')}}</label>
                    <input type="number" class="amount" name="amount" required placeholder="{{awtTrans('مبلغ العقار')}}" lang="en">
                    <input type="hidden" name="type" value="{{$type}}">
                </div>

                <div class="form-group input-text">
                    <label for="" class="label">{{awtTrans('المبلغ المستحق دفعه')}}</label>

                    <input type="text" id="price" readonly placeholder="{{awtTrans('العمولة المستحقة ستظهر هنا')}}">
                </div>

                <button type="submit" class="continue-btn">{{awtTrans('دفع العمولة')}}</button>
            </form>

        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    $('.amount').on('keyup', function() {

        var amount = parseInt($('.amount').val());
        var price = amount * {{$data}} / 100 ;

        $('#price').html('')
        $('#price').val(price ? price : 0);
    });
</script>
@endsection
