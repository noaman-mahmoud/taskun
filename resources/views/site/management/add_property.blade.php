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

    <div class="form-section">
        <div class="container">
            <form action="{{url('post-add-property')}}" class="main-form" id="AddProperty" method="post">
                @csrf
                <!-- section - preview -->
                <div class="form-group input-text">
                    <label for="" class="label">{{awtTrans('أسم العقار')}}</label>
                    <input type="text" name="name" placeholder="{{awtTrans('برج النعماني')}}">
                </div>

                <div class="form-group">
                    <label for="" class="label">{{awtTrans('نوع العقار')}}</label>
                    <select name="estate_type_id" id="" class="select">
                      @foreach($types as $type)
                        <option value="{{$type->id}}"> {{$type->name}} </option>
                      @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="" class="label">{{awtTrans('نوع السكن')}}</label>
                    <select name="housing_type_id" id="" class="select">
                      @foreach($housing as $house)
                        <option value="{{$house->id}}">{{$house->name}}</option>
                      @endforeach
                    </select>
                </div>

                <div class="form-group location-input location-with-icon">
                    <label for="" class="label">{{awtTrans('موقع العقار')}}</label>
                    <input type="text" readonly="" id="address" name="address" class="bg-transparent  form-control" data-toggle="modal" data-target="#staticBackdrop">
                    <input type="hidden" name="lat" id="lat" value="46.738586">
                    <input type="hidden" name="lng" id="lng" value="24.774265">
                    <i class="fas fa-map-marker-alt"></i>
                </div>

                <div class="title-info-location">
                    <span class="hint">{{awtTrans('سيتم تحديد الموقع علي الخريطه')}}</span>
                    <span class="info-unit">{{awtTrans('معلومات الأدوار')}}</span>
                </div>

                <div class="form-group input-text">
                    <label for="" class="label">{{awtTrans('عدد الأدوار')}}</label>
                    <input type="number" name="number_roles" placeholder="3" lang="en">
                </div>
                <button type="submit" class="continue-btn bg-green">{{awtTrans('حفظ')}}</button>
            </form>
        </div>
    </div>
</section>

<!-- map modal -->
<div class="location">
    <!-- Modal -->
    <div class="modal fade maxvh topz overflow-hidden" id="staticBackdrop" data-backdrop="static"
         data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="map">

                        <div class="form-group">
                            <div id="map" style=" height: 400px;"></div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{awtTrans('اغلاق')}}</button>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
@section('scripts')
    {!! jsValidation('Api\Management\AddProperty', '#AddProperty') !!}
    <script type="text/javascript" src='https://maps.google.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyA9_ve_oT3ynCaAF8Ji4oBuDjOhWEHE92U&language=ar'></script>
    <script>
        var map;
        var marker;
        var myLatlng = new google.maps.LatLng(24.774265, 46.738586);
        var geocoder = new google.maps.Geocoder();
        var infowindow = new google.maps.InfoWindow();

        function initMap() {
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

            geocoder.geocode({ 'latLng': myLatlng }, function (results, status) {
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

            google.maps.event.addListener(marker, 'dragend', function () {

                geocoder.geocode({ 'latLng': marker.getPosition() }, function (results, status) {
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
@endsection
