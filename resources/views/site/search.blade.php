@extends('site.layouts.master')

@section('content')
    <section class="content orange">
        <!-- banner- section -->
        <div class="banner-section banner-show" style="background-image: url({{asset('website/img/banner-home.png')}});">
            <div class="container">
                <div class="info">
                    <p class="title">{{awtTrans('البحث')}}</p></p>
                </div>
            </div>
        </div>

        <div class="tabs-list">
            <div class="container">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="tab-content w-100" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                 aria-labelledby="nav-home-tab">
                                <!-- ****************************** first-main-tab ***************************************** -->

                                <div class="filter-tabs category-item">
                                    <div class="tab-content" id="pills-tabContent">
                                        <!-- first- tab -->
                                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                             aria-labelledby="pills-home-tab">
                                            <div class="row">
                                              @if(!empty($estates))
                                                @foreach($estates as $estate)
                                                    <div class="col-12 col-xl-4 col-lg-6 col-md-6 col-sm-12">
                                                        <a href="{{url('estate-details/'.$estate['id'])}}" class="category-box">
                                                            <img src="{{ $estate['image']}}" alt="" class="categor-img">
                                                            <div class="info">
                                                                <h1 class="title">{{$estate['title']}}</h1>
                                                                <p class="salary">{{isset($estate['price']) ? $estate['price'] : ''}}</p>
                                                                <p class="disc">{{$estate['address']}}</p>
                                                                <div class="view">
                                                                 <p class="icon-view">
                                                                    <span>
                                                                      <i class="far fa-thumbs-up"></i>
                                                                      {{$estate['likes']}}
                                                                    </span>
                                                                    <span>
                                                                      <i class="far fa-eye"></i>
                                                                      {{$estate['views']}}
                                                                    </span>
                                                                 </p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                @endforeach
                                              @else
                                                <p>{{awtTrans(' لا يوجد نتائج بحث')}}</p>
                                              @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>

    </section>
@endsection

@section('scripts')

@endsection
