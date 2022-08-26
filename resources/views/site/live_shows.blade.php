@extends('site.layouts.master')
@push('style')
    <style>
        .hidden{ display: none}
    </style>
@endpush
@section('content')
<section class="content">

   <div class="banner-section banner-show" style="background-image: url({{asset('website/img/banner-home.png')}});">
    <div class="container">
        <div class="info">
            <p class="title">{{awtTrans('العقارات')}}</p>
        </div>
    </div>
   </div>

   <div class="tabs-list">

    <div class="container">
        <div class="row">

            <div class="col-12 col-lg-3 col-md-4 col-sm-12">
                <div class="overlay-filter-input"></div>
                <div class="filter-input">
                    <form action="{{url('estates-filter')}}" method="post" class="form-body">
                        @csrf
                        <div class="custom-label">
                            <p class="head-label">{{awtTrans('نوع الاعلان')}}</p>
                            <label class="custom-check">
                                <input type="radio" class="" name="sale_type" value="limit" checked>
                                <div class="check-inner">
                                    <i class="fas fa-check"></i>
                                    <p class="hint">{{awtTrans('حد')}}</p>
                                </div>
                            </label>
                            <label class="custom-check">
                                <input type="radio" class="" name="sale_type" value="som">
                                <div class="check-inner">
                                    <i class="fas fa-check"></i>
                                    <p class="hint">{{awtTrans('سوم')}}</p>
                                </div>
                            </label>
                        </div>

                        <div class="custom-label">
                            <p class="head-label">{{awtTrans('تاريخ الاضافة')}}</p>
                            @foreach ($years as $year)
                                <label class="custom-check">
                                    <input type="radio" value="{{$year['date']}}" name="year" >
                                    <div class="check-inner">
                                        <i class="fas fa-check"></i>
                                        <p class="hint">{{$year['date']}}</p>
                                    </div>
                                </label>
                            @endforeach

                        </div>

                        <div class="custom-label">
                            <p class="head-label">{{awtTrans('صلاحيه الأعلان')}}</p>
                            <label class="custom-check">
                                <input type="radio" class="" name="created" checked>
                                <div class="check-inner">
                                    <i class="fas fa-check"></i>
                                    <p class="hint">{{awtTrans('كل الأعلانات')}}</p>
                                </div>
                            </label>

                            <label class="custom-check">
                                <input type="radio" class="" name="created" value="7">
                                <div class="check-inner">
                                    <i class="fas fa-check"></i>
                                    <p class="hint">{{awtTrans('جديده')}}</p>
                                </div>
                            </label>

                            <label class="custom-check">
                                <input type="radio" class="" name="created" value="14">
                                <div class="check-inner">
                                    <i class="fas fa-check"></i>
                                    <p class="hint">{{awtTrans('متوسطه')}}</p>
                                </div>
                            </label>

                            <label class="custom-check">
                                <input type="radio" class="" name="created" value="21">
                                <div class="check-inner">
                                    <i class="fas fa-check"></i>
                                    <p class="hint">{{awtTrans('قديمه')}}</p>
                                </div>
                            </label>
                        </div>

                        <div class="rangee">
                            <p class="head-range">{{awtTrans('السعر')}}</p>
                            <input type="text" class="js-range-slider" name="price" value=""
                                   data-curensy="{{awtTrans('ر.س')}}"/>
                        </div>

                        @foreach($features as $feature)

                            @if(in_array($feature['type'],['select']))
                                <div class="custom-label custom-edit">
                                    <p class="head-label">{{$feature['name']}}</p>
                                    <select name="features[{{$feature['id']}}]" id="" class="select">
                                        <option selected disabled>{{awtTrans('تحديد')}}</option>
                                        @foreach($feature['options'] as $options)
                                            <option value="{{$options['id']}}">{{$options['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @elseif(in_array($feature['type'],['text']))
                                <div class="rangee">
                                    <p class="head-range">{{$feature['name']}}</p>
                                    <input type="text" class="js-range-slider-3" name="features[{{$feature['id']}}]" value="" />
                                </div>
                            @else
                                <div class="input-number">
                                    <label for="">{{$feature['name']}}</label>
                                    <input type="{{$feature['type']}}" placeholder="{{$feature['name']}}"
                                           name="features[{{$feature['id']}}]" {{$feature['type'] == 'number' ?  'lang="en"' : ''}}>
                                </div>
                            @endif

                        @endforeach

                        <div class="custom-label custom-edit">
                            <p class="head-label">{{awtTrans('أضافات')}}</p>
                            @foreach($additions as $addition)
                               <label class="custom-check">
                                <input type="checkbox" class="" value="{{$addition->id}}" name="additions[]" >
                                <div class="check-inner">
                                    <span class="box"><i class="fas fa-check"></i></span>
                                    <p class="hint">{{$addition->name}}</p>
                                </div>
                            </label>
                            @endforeach
                        </div>

                        @if(isset($broker))
                          <input type="hidden" name="user_type" value="{{$broker->user_type}}">
                          <input type="hidden" name="broker"    value="{{$broker->id}}">
                        @endif
                        <button type="submit" class="submit-btn mrg-btn bg-blue w-100">{{awtTrans('تصفية')}}</button>
                    </form>
                </div>
            </div>

            <div class="col-12 col-lg-9 col-md-12">

                <div class="filter-tabs category-item">

                    <ul class="nav nav-pills tab-list map-list" id="pills-tab" role="tablist">
                        <li class="nav-item active">
                            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home"
                               role="tab" aria-controls="pills-home" aria-selected="true">{{awtTrans('قائمة')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile"
                               role="tab" aria-controls="pills-profile" aria-selected="false">{{awtTrans('خريطة')}}</a>
                        </li>
                    </ul>

                    <form action="" class="map-form">
                        <div class="input-search">
                            <i class="fas fa-filter filter-icon"></i>
                            <div class="input-map input-search">
                                <i class="fas fa-search search"></i>
                                <input type="text" placeholder="{{awtTrans('بحث')}}">
                            </div>
                        </div>

                    </form>

                    <div class="tab-content" id="pills-tabContent">
                        <!-- first- tab -->
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                             aria-labelledby="pills-home-tab">

                            <form action="{{url('estates-search')}}" method="post" class="map-form">
                                @csrf
                                <div class="check-btn">
                                    <div class="custom-radio">
                                        <label class="radio">
                                            <input type="radio" value="sell" name="type" checked>
                                            <div class="check-inner">
                                                <p class="hint">{{awtTrans('بيع')}}</p>
                                            </div>
                                        </label>

                                        <label class="radio">
                                            <input type="radio" value="rent" name="type">
                                            <div class="check-inner">
                                                <p class="hint">{{awtTrans('ايجار')}}</p>
                                            </div>
                                        </label>
                                    </div>

                                    <div class="custom-radio">
                                        @foreach($estateCate as $estateCategory)
                                        <label class="radio">
                                            <input type="radio" value="{{$estateCategory->id}}" name="estate_category_id"
                                                   @if ($loop->first) checked @endif>
                                            <div class="check-inner">
                                                <p class="hint">{{$estateCategory->name}}</p>
                                            </div>
                                        </label>
                                        @endforeach
                                    </div>

                                    <div class="custom-label mrg-check">
                                      @foreach($categories as $category)
                                        <label class="custom-check">
                                            <input type="radio" name="category_id" value="{{$category->id}}">
                                            <div class="check-inner">
                                                <i class="fas fa-check"></i>
                                                <p class="hint">{{$category->name}}</p>
                                            </div>
                                        </label>
                                      @endforeach
                                    </div>
                                </div>
                                @if(isset($broker))
                                    <input type="hidden" name="user_type" value="{{$broker->user_type}}">
                                    <input type="hidden" name="broker"    value="{{$broker->id}}">
                                @endif
                                <button type="submit" class="submit-btn mrg-btn bg-blue mb-4">{{awtTrans('بحث')}}</button>
                            </form>

                            <div class="row">
                               @if($estates->isNotEmpty())
                                @foreach($estates as $estate)
                                    <div class="col-12 col-xl-4 col-lg-6 col-md-6 col-sm-12 card">
                                        <a href="{{url('estate-details/'.$estate->id)}}" class="category-box">
                                            <img src="{{ $estate->estateImage->image}}" alt="" class="categor-img">
                                            <div class="info">
                                                <h1 class="title">{{$estate->title}}</h1>
                                                <p class="salary">{{isset($estate->price) ? $estate->price : ''}}</p>
                                                <p class="disc">{{$estate->address}}</p>
                                                <div class="view">
                                                    {{-- <p class="hint">يبعد 10 كيلو</p>--}}
                                                    <p class="icon-view">
                                                    <span>
                                                        <i class="far fa-thumbs-up"></i>
                                                        {{isset($estate->likes) ? $estate->likes->sum('count') : 0 }}
                                                    </span>
                                                        <span>
                                                        <i class="far fa-eye"></i>
                                                        {{$estate->views}}
                                                    </span>
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                               @else
                                <h1>{{awtTrans(' لا يوجد نتائج بحث')}}</h1>
                               @endif
                            </div>

                            <div class="pagination">
                                @if ($estates->hasPages())
                                    {{$estates->links()}}
                                @endif
                            </div>

                        </div>

                        <!-- sec-tab -->

                        <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                             aria-labelledby="pills-profile-tab">
                            <div class="map-section">
                                <button class="theme-btn bg-blue d-none">
                                    <i class="fas fa-arrow-left"></i>
                                </button>
                                <div id="map"></div>
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
                            @foreach(\App\Models\Estate::with('estateImage')
                                   ->where(['city_id'=>$city->id ,'user_type'=>'owner','publish'=>1])->get() as $Estate)
                        {
                            placeName:"{{$Estate->title}}",
                            price:    "{{isset($Estate->price) ? $Estate->price : ''}}",
                            link:     "{{url('estate-details/'.$Estate->id)}}",
                            img:      "{{$Estate->estateImage->image}}",
                            icon:     "{{asset('website/img/bl-marker.png')}}",
                            LatLng: [{
                                lat: {{$Estate->lat}},
                                lng: {{$Estate->lng}}
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
                    contentString += `<a href="${markersOnMap[i].link}" class="link">{{awtTrans('مشاهدة المزيد')}}</a>`;
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

