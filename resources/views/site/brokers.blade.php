@extends('site.layouts.master')

@section('content')

<section class="content orange">
    <!-- banner- section -->
    <div class="banner-section banner-show" style="background-image: url({{asset('website/img/banner-home.png')}});">
        <div class="container">
            <div class="info">
                <p class="title">{{awtTrans('وسطاء عقاريون')}}</p>
            </div>
        </div>
    </div>

    <div class="tabs-list">
        <div class="container">
            <div class="links-tabs">
                <nav class="nav-links">
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home"
                           role="tab" aria-controls="nav-home" aria-selected="true">
                            {{awtTrans('مكاتب عقاريه')}}
                        </a>

                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile"
                           role="tab" aria-controls="nav-profile" aria-selected="false">
                            {{awtTrans('مسوق عقاري')}}
                        </a>
                    </div>
                </nav>
                <form action="" class="map-form">
                    <div class="input-search">
                        <div class="input-map input-search">
                            <i class="fas fa-search search"></i>
                            <input type="text" placeholder="{{awtTrans('بحث')}}">
                        </div>
                    </div>
                </form>

            </div>

            <div class="links-tabs">
                <ul class="nav nav-tabs tap-list" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link tap-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                           aria-controls="home" aria-selected="true">{{awtTrans('قائمة')}}</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link tap-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                           aria-controls="profile" aria-selected="false">{{awtTrans('خريطة')}}</a>
                    </li>

                </ul>
            </div>

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
                                          @foreach($offices as $office)
                                            <div class="col-12 col-lg-4 col-xl-3 col-md-6 col-sm-12 card">
                                                <a href="{{url('broker-details/'.$office->uuid)}}" class="category-box">
                                                    <img src="{{$office->avatar}}" alt="" class="categor-img">
                                                    <div class="info">
                                                        <h1 class="title">{{$office->name}}</h1>
                                                        <p class="disc">{{$office->address}}</p>
                                                        <p class="salary cl-orange">
                                                            <i class="fas fa-bullhorn"></i>
                                                            {{awtTrans('عدد الأعلانات')}}

                                                              {{$office->estates_count}}

                                                            {{awtTrans('أعلان')}}
                                                        </p>
                                                        <div class="view"> </div>
                                                    </div>
                                                </a>
                                            </div>
                                          @endforeach
                                        </div>

                                        <div class="pagination">
                                          @if ($offices->hasPages()) {{ $offices->links()}} @endif
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- *********************************** sec-main-tab ***************************************-->

                        <div class="tab-pane fade category-item" id="nav-profile" role="tabpanel"
                             aria-labelledby="nav-profile-tab">
                            <div class="row">
                               @foreach($marketers as $marketer)
                                  <div class="col-12 col-lg-4 col-xl-3 col-md-6 col-sm-12 card">
                                    <a href="{{url('broker-details/'.$marketer->uuid)}}" class="category-box">
                                        <img src="{{$marketer->avatar}}" alt="" class="categor-img">
                                        <div class="info">
                                            <h1 class="title">{{$marketer->name}}</h1>
                                            <p class="disc">{{$marketer->address}}</p>
                                            <p class="salary cl-orange">
                                                <i class="fas fa-bullhorn"></i>
                                                {{awtTrans('عدد الأعلانات')}}

                                                {{$marketer->estates_count}}

                                                {{awtTrans('أعلان')}}
                                            </p>

                                            <div class="view"> </div>
                                        </div>
                                    </a>
                                </div>
                               @endforeach
                            </div>

                            <div class="pagination">
                                @if ($marketers->hasPages()) {{$marketers->links()}} @endif
                            </div>

                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="map-section">
                        <button class="theme-btn bg-orange d-none">
                            <i class="fas fa-arrow-left"></i>
                        </button>
                        <p class="map-text d-none">جدة , الرياض , السعودية</p>
                        <div id="map"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection

@section('scripts')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBxxPg8KdqwqZcSP9My8yDIg0Wxbrtvg7w&language=ar&callback=initMap"
            defer></script>
    <script>
        var map;
        var InforObj = [];
        var centerCords;
        var markersOnMap;
        var addMarker;

        let officeFunc   = function() {

            centerCords  = { lat: 24.774265,lng: 46.738586};
            markersOnMap = [
                    @foreach($cities as $city)
                {
                    // icon: "img/elrith.png",
                    LatLng: [{
                        lat: {{$city->lat}},
                        lng: {{$city->lng}},
                    }],
                    custom:'test-2',
                    text:'{{$city->name}}',
                    data: [
                         @foreach(\App\Models\User::where(['city_id'=>$city->id ,'active'=>1 ,'block'=>0])
                                ->where('user_type','<>','owner')->get() as $user)
                        {
                            placeName:"{{$user->name}}",
                            price:'',
                            link:     "{{url('broker-details/'. $user->uuid)}}",
                            img:      "{{$user->avatar}}",
                            icon:     "{{asset('website/img/map-marker.png')}}",
                            LatLng: [{
                                lat: {{$user->lat}},
                                lng: {{$user->lng}}
                            }]
                        },
                        @endforeach
                    ]
                },
                @endforeach
            ];
            window.onload = function () {
                initMap();
            };

            function closeOtherInfo() {
                if (InforObj.length > 0) {
                    /* detach the info-window from the marker ... undocumented in the API docs */
                    InforObj[0].set("marker", null);
                    /* and close it */
                    InforObj[0].close();
                    /* blank the array */
                    InforObj.length = 0;
                }
            }

            addMarker = function() {
                for (var i = 0; i < markersOnMap.length; i++) {
                    var contentString = '';

                    const marker = new google.maps.Marker({
                        position: markersOnMap[i].LatLng[0],
                        map: map,
                        icon: markersOnMap[i].icon,
                        data: markersOnMap[i].data,
                        label:{
                            text: markersOnMap[i].text,
                            className: markersOnMap[i].custom,

                        },
                    });

                    const infowindow = new google.maps.InfoWindow({
                        content: contentString,
                        maxWidth: 200
                    });

                    marker.addListener('click', function (event) {
                        adressFunc(marker.data)
                        initMap()
                        $('.map-section .theme-btn').removeClass('d-none');
                    });
                }
            }
        }

        let adressFunc   = function(data) {

            centerCords  = { lat: 24.774265, lng: 46.738586 };
            markersOnMap = data;

            window.onload = function () {
                initMap();
            };

            addMarker = function () {
                for (var i = 0; i < markersOnMap.length; i++) {
                    var contentString = '';
                    contentString += `<div class="img">`;
                    contentString += `<img src="${markersOnMap[i].img}" alt="">`;
                    contentString += `</div>`;
                    contentString += `<div class="info">`;
                    contentString += `<p class="title"> ${markersOnMap[i].placeName}</p>`;
                    contentString += `<span class="price"> ${markersOnMap[i].price}</span>`;
                    contentString += `<a href="${markersOnMap[i].link}" class="link">مشاهدة المزيد</a>`;
                    contentString += `</div>`;

                    const marker = new google.maps.Marker({
                        position: markersOnMap[i].LatLng[0],
                        map: map,
                        icon: markersOnMap[i].icon
                    });

                    const infowindow = new google.maps.InfoWindow({
                        content: contentString,
                        maxWidth: 200
                    });

                    marker.addListener('click', function () {
                        closeOtherInfo();
                        infowindow.open(marker.get('map'), marker);
                        InforObj[0] = infowindow;
                    });
                }
            }

            function closeOtherInfo() {
                if (InforObj.length > 0) {
                    /* detach the info-window from the marker ... undocumented in the API docs */
                    InforObj[0].set("marker", null);
                    /* and close it */
                    InforObj[0].close();
                    /* blank the array */
                    InforObj.length = 0;
                }
            }

            initMap()
        }

        officeFunc()

        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 8,
                center: centerCords
            });
            addMarker();
        };

        $('.map-section .theme-btn').click(function() {
            officeFunc()
            initMap()
            $(this).addClass('d-none')
        })

    </script>
    <script>
        $(document).ready(function() {

            $(".input-search input").on("keyup", function() {

                var value = $(this).val().toLowerCase();

                $(".row .card").filter(function() {

                    $(this).toggle($(this).find('h1').text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
@endsection
