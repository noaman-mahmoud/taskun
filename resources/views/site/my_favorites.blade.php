@extends('site.layouts.master')
@section('content')

<section class="content orange">
    <!-- banner- section -->
    <div class="banner-section banner-show" style="background-image: url({{url('website/img/banner-home.png')}});">
        <div class="container">
            <div class="info">
                <p class="title">{{awtTrans('مفضلتي')}}</p>
            </div>
        </div>
    </div>

    <div class="category-item">
        <div class="container">
            <div class="row">
              @foreach($estates as $estate)
                <div class="col-12 col-lg-4 col-xl-3 col-md-6 col-sm-12">
                    <div class="category-box category-ps">
                        <img src="{{$estate['image']}}" alt="" class="categor-img">
                        <a href="{{url('estate-details/'.$estate['id'])}}"  class="info d-block">
                            <h1 class="title">{{$estate['title']}}</h1>
                            <p class="salary">{{isset($estate['price']) ? $estate['price'] : ' '}}</p>
                            <p class="disc">{{$estate['address']}}</p>
{{--                            <div class="view">--}}
{{--                                <p class="hint">يبعد 10 كيلو</p>--}}
{{--                            </div>--}}
                        </a>
                        <i class="fas fa-heart fave active favorite" data-id="{{$estate['id']}}"></i>
                    </div>
                </div>
              @endforeach
            </div>
        </div>
    </div>
</section>

@endsection
@section('scripts')
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.all.min.js"></script>
  <script>
    $(document).ready(function(){
        $('.favorite').on('click', function(){
            var estate = $(this).data('id')
            $.ajax({
                url: '{{url('favorite')}}',
                type: 'post',
                data: { "_token": "{{ csrf_token() }}" , 'estate_id': estate},
                success: function(response){
                    Swal.fire({
                        icon: 'success',
                        title: '{{trans('site.favorite')}}',
                        text: response['msg'],
                        timer: 2500,
                    })
                },
            })
        });
    });
   </script>
@endsection
