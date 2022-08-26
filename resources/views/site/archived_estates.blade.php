@extends('site.layouts.master')
@section('content')
    <section class="content">
        <!-- banner- section -->
        <div class="banner-section banner-show" style="background-image: url({{url('website/img/banner-home.png')}});">
            <div class="container">
                <div class="info">
                    <p class="title">{{awtTrans('الارشيف')}}</p>
                </div>
            </div>
        </div>

        <div class="category-item">
            <div class="container">
                <div class="row">
                  @foreach($estates as $estate)
                      <div class="col-12 col-lg-4 col-xl-3 col-md-6 col-sm-12">
                        <a href="{{url('estate-details/'.$estate['id'])}}" class="category-box category-ps">
                            <img src="{{$estate['image']}}" alt="" class="categor-img">
                            <div class="info">
                                <h1 class="title">{{$estate['title']}}</h1>
                                <p class="salary">{{isset($estate['price']) ? $estate['price'] : ' '}}</p>
                                <p class="disc">{{$estate['address']}}</p>
                                <div class="view">
                                    <p class="hint">{{awtTrans('تاريخ الأرشفه')}}:
                                        {{$estate['created']}}
                                    </p>
                                </div>
                            </div>
                            <img src="{{asset('website/img/folder.png')}}" class="folder-img" alt="">
                        </a>
                    </div>
                  @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
