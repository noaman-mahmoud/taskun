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

    <div class="container">
        <form action="" class="map-form product-form input-search">
            <div class="input-search">
                <div class="input-map">
                    <i class="fas fa-search search"></i>
                    <input type="text" id="box" placeholder="{{awtTrans('بحث')}}">
                </div>
            </div>
            <a href="{{url('add-property')}}" class="product-btn">
                <span class="plus"><i class="fas fa-plus"></i></span>
                {{awtTrans('أضف عقارك')}}
            </a>
        </form>
    </div>

    <div class="tower-homr">
        <div class="container">
            <div class="row">
              @foreach($properties as $property)
                <div class="col-12 col-lg-4 col-xl-3 col-md-6 col-sm-12 cat">
                    <a href="{{url('property-details/'.$property['id'])}}" class="item">
                        <img src="{{$property['image']}}" alt="">
                        <h5 class="title">{{$property['name']}}</h5>
                        <p class="disc">{{$property['address']}}</p>
                        <p class="hint">{{awtTrans('عدد الشقق')}} : {{$property['units']}}</p>
                    </a>
                </div>
              @endforeach
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {

        $(".input-search input").on("keyup", function() {

            var value = $(this).val().toLowerCase();

            $(".row div").filter(function() {

                $(this).toggle($(this).find('h5').text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>
@endsection
