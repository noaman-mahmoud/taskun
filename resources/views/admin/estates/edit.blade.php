@extends('admin.layout.master')
{{-- extra css files --}}
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css-rtl/plugins/forms/validation/form-validation.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/vendors/css/extensions/sweetalert2.min.css')}}">
@endsection
{{-- extra css files --}}

@section('content')
    <!-- // Basic multiple Column Form section start -->
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{awtTrans('عرض العقار ')}}</h4>
                    </div>

                    <div class="card-content">
                        <div class="card-body">
                            <form  method="POST" action="{{route('admin.estates.update' , ['id' => $row->id])}}" class="store form-horizontal" novalidate>
                                @csrf
                                @method('PUT')
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{awtTrans('اسم صاحب العقار')}}</label>
                                                <div class="controls">
                                                    <input type="text" name="name_ar" value="{{$row->provider->name}}" class="form-control" disabled >
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{awtTrans('جوال صاحب العقار')}}</label>
                                                <div class="controls">
                                                    <input type="text" name="name_ar" value="{{$row->provider->phone}}" class="form-control" disabled >
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{awtTrans('العنوان الرئيسي')}}</label>
                                                <div class="controls">
                                                    <input type="text" name="price" value="{{$data['title']}}" class="form-control" disabled >
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{awtTrans('النوع')}}</label>
                                                <div class="controls">
                                                    <input type="text" name="price" value="{{$data['type']}}" class="form-control" disabled >
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{awtTrans('النوع البيع')}}</label>
                                                <div class="controls">
                                                    <input type="text" name="price" value="{{$data['sale_type']}}" class="form-control" disabled >
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{awtTrans('السعر')}}</label>
                                                <div class="controls">
                                                    <input type="text" name="price" value="{{$data['price']}}" class="form-control" disabled >
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{awtTrans('القسم')}}</label>
                                                <div class="controls">
                                                    <input type="text" name="price" value="{{$data['category']}}" class="form-control" disabled >
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{awtTrans('قسم الفرعي')}}</label>
                                                <div class="controls">
                                                    <input type="text" name="price" value="{{$data['estate_category']}}" class="form-control" disabled >
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{awtTrans('المدينه')}}</label>
                                                <div class="controls">
                                                    <input type="text" name="price" value="{{$data['city']}}" class="form-control" disabled >
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{awtTrans('الحي')}}</label>
                                                <div class="controls">
                                                    <input type="text" name="price" value="{{$data['neighborhood']}}" class="form-control" disabled >
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <!-- بداية مميزات الشاليه  -->
                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <h6>المميزات </h6>
                                                <ul class="chalet_features">
                                                    @foreach($data['features'] as $feature)
                                                        <li>
                                                            <div class="panafsig">
                                                                <aside>
                                                                    <img src="{{$feature['image']}}">
                                                                </aside>
                                                                <div class="counter">
                                                                    <span style="margin-right: 20px; color: red">{{$feature['value']}}</span>
                                                                </div>
                                                                <div>{{$feature['name']}}</div>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                        <!-- نهاية مميزات الشاليه  -->
                                        
                                        <!-- بداية مميزات الشاليه  -->
                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <h6>الاضافات</h6>
                                                <ul class="chalet_features">
                                                    @foreach($data['additions'] as $addition)
                                                        <li>
                                                            <div class="panafsig">
                                                                <aside>
                                                                    <img src="{{$addition['image']}}">
                                                                </aside>
{{--                                                                <div class="counter">--}}
{{--                                                                    {{$feature->feature->feature}}--}}
{{--                                                                    <span style="margin-right: 20px; color: red">{{$feature->value}}</span>--}}
{{--                                                                </div>--}}
                                                                <div>{{$addition['name']}}</div>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                        <!-- نهاية مميزات الشاليه  -->

                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{awtTrans('الوصف ')}}</label>
                                                <div class="controls">
                                                    <textarea name="description_ar" rows="4" class="form-control" disabled>{{$data['description']}}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{awtTrans('العنوان')}}</label>
                                                <div class="controls">
                                                    <input type="text" name="address" readonly value="{{$row->address}}" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12" style="clear: both">
                                            <h6 >العنوان علي الخريطة</h6>

                                            <div class="form-group  col-md-12">
                                                <div id="map" style="width: 100%;height:250px;"></div>
                                                <input type="hidden" id="resultAddress" name="address" class="form-control"
                                                       placeholder=" تفاصيل العنوان " readonly>


                                                <input type="hidden" id="lat" value="{{$row->lat}}" name="lat" class="form-control">
                                                <input type="hidden" id="lng" value="{{$row->lng}}" name="lng" class="form-control">
                                            </div>
                                        </div>



                                        <div class="col-12 d-flex justify-content-center mt-3">
                                            {{--                                        <button type="submit" class="btn btn-primary mr-1 mb-1 submit_button">{{awtTrans('تعديل')}}</button>--}}
                                            <a href="{{ url()->previous() }}" type="reset" class="btn btn-outline-warning mr-1 mb-1">{{awtTrans(' رجوع ')}}</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('js')
    <script src="{{asset('admin/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js')}}"></script>
    <script src="{{asset('admin/app-assets/js/scripts/forms/validation/form-validation.js')}}"></script>
    <script src="{{asset('admin/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('admin/app-assets/js/scripts/extensions/sweet-alerts.js')}}"></script>

    {{-- show selected image script --}}
    @include('admin.shared.addImage')
    {{-- show selected image script --}}

    {{-- submit edit form script --}}
    @include('admin.shared.submitEditForm')
    {{-- submit edit form script --}}

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDAcNGRxy3xOCZTxU3TBg-TyUsEgbU1ltU&callback=initMap&language=ar"></script>
    <script>
        var map;
        var marker;
        var lat = '{{$row->lat}}';
        var lng = '{{$row->lng}}';

        var myLatlng = new google.maps.LatLng(lat,lng);
        var geocoder = new google.maps.Geocoder();
        var infowindow = new google.maps.InfoWindow();

        function initMap(){
            var mapOptions = {
                zoom: 10,
                center: myLatlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };

            map = new google.maps.Map(document.getElementById("map"), mapOptions);

            marker = new google.maps.Marker({
                map: map,
                position: myLatlng,
                draggable: true
            });

            geocoder.geocode({'latLng': myLatlng }, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[0]) {
                        $('#latitude,#longitude').show();
                        $('#address').val(results[0].formatted_address);
                        $('#resultAddress').val(results[0].formatted_address);
                        $('#latitude').val(marker.getPosition().lat());
                        $('#longitude').val(marker.getPosition().lng());
                        infowindow.setContent(results[0].formatted_address);
                        infowindow.open(map, marker);
                    }
                }
            });

            google.maps.event.addListener(marker, 'dragend', function() {

                geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        if (results[0]) {
                            $('#address').val(results[0].formatted_address);
                            $('#resultAddress').val(results[0].formatted_address);
                            $('#lat').val(marker.getPosition().lat());
                            $('#lng').val(marker.getPosition().lng());
                            infowindow.setContent(results[0].formatted_address);
                            infowindow.open(map, marker);
                        }
                    }
                });
            });

        }
        google.maps.event.addDomListener(window, 'load', initMap);


    </script>
    <script>
        $(document).ready(function () {
            "use strict";
            $(".qty-up").on("click", function (e) {
                e.preventDefault();
                var theNumber = parseInt($(this).next(".qty-val").val());
                if (theNumber >= 0) {
                    $(this).next(".qty-val").val(theNumber + 1);
                }
            });

            $(".qty-down").on("click", function (e) {
                e.preventDefault();
                var theNumber = parseInt($(this).prev(".qty-val").val());
                if (theNumber > 0) {
                    $(this).prev(".qty-val").val(theNumber - 1);
                }
            });
        });
    </script>
@endsection
