@extends('site.layouts.master')


@section('content')

<section class="content">
    <!-- banner- section -->
    <div class="banner-section banner-show" style="background-image: url({{url('website/img/banner-home.png')}});">
        <div class="container">
            <div class="info">
                <p class="title">{{awtTrans('تسجيل جديد')}}</p>
            </div>
        </div>
    </div>

    <div class="form-section">
        <div class="container">

            <form action="{{url('post-sign-up')}}" method="post" enctype="multipart/form-data" class="main-form" id="signUp">
                @csrf
                <div class="form-group input-text">
                    <label for="" class="label">{{awtTrans('اسم المستخدم')}}</label>
                    <input type="text" name="name" placeholder="{{awtTrans('اسم المستخدم')}}">
                </div>

                <div class="form-group input-select">
                    <label for="" class="label">{{awtTrans('نوع الحساب')}}</label>
                    <select name="user_type" id="" class="select">
                        <option value="owner">{{awtTrans('مالك مباشر أو باحث عن عقار')}}</option>
                        <option value="office" data-attr="real-estate-office">{{awtTrans('مكتب عقاري')}}</option>
                        <option value="marketer"  data-attr="real-estate-office">{{awtTrans('مسوق عقاري')}}</option>
                    </select>
                </div>

                <div class="form-group input-text input-estate-office d-none">
                    <input type="text" name="commercial" placeholder="{{awtTrans('السجل التجاري')}}" pattern="[0-9]+" lang="en">
                </div>

                <div class="form-group input-text input-estate-office d-none">
                    <input type="number" name="advertiser_number" placeholder="{{awtTrans('رقم المعلن العقاري')}}" main="5" pattern="[0-9]+" lang="en">
                </div>

                <div class="phone-input form-group input-number">
                    <label class="label">رقم الجوال</label>
                    <input type="number" name="phone" id="phone" placeholder="0540000000" min="9" pattern="[0-9]+" lang="en">
                    <input type="hidden" name="device_id" value="3838883833838">
                    <input type="hidden" name="device_type" value="web">
                    <input type="hidden" name="mac_address" value="web-39939393">
                </div>

                <div class="form-group input-estate-office d-none">
                    <label for="" class="label">{{awtTrans('المدينة')}}</label>
                    <select name="city_id" id="" class="select">
                      @foreach($cities as $city)
                        <option value="{{$city->id}}">{{$city->name}}</option>
                      @endforeach
                    </select>
                </div>

                <div class="form-group location-input location-with-icon input-estate-office d-none">
                    <label for="" class="label">{{awtTrans('الموقع')}}</label>
                    <input type="text" readonly name="address" id="address" class="bg-transparent  form-control"
                           data-toggle="modal" data-target="#staticBackdrop">
                    <i class="fas fa-map-marker-alt"></i>
                    <input type="hidden" name="lat" id="lat" value="24.774265">
                    <input type="hidden" name="lng" id="lng" value="46.738586">
                </div>

                <div class="form-group input-text with-hint">
                    <input type="email" name="email" placeholder="{{awtTrans('البريد الالكتروني')}}">
                    <span class="hint">{{awtTrans('(اختياري)')}}</span>
                </div>

                <div class="form-group input-text">
                    <input type="password" name="password" placeholder="{{awtTrans('كلمة المرور')}}" min="6">
                </div>

                <div class="form-group input-text">
                    <input type="password" name="password" placeholder="{{awtTrans('تأكيد كلمة المرور')}}" min="6">
                </div>

                <p href="#" class="register-now cl-tr-blue mb-4">
                    {{awtTrans('الموافقة علي جميع')}}
                    <a href="{{url('terms')}}" target="_blank" class="register-link">
                        {{awtTrans('الشروط والاحكام')}}
                    </a>
                </p>

                <button type="submit" class="continue-btn">{{awtTrans('تسجيل')}}</button>

                <p class="register-now">
                    {{awtTrans('هل لديك حساب ؟')}}
                    <a href="{{url('sign-in')}}">{{awtTrans('سجل دخول')}}</a>
                </p>
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
    {!! jsValidation('Api\Auth\RegisterRequest', '#signUp') !!}

    <script type="text/javascript"
            src='https://maps.google.com/maps/api/js?sensor=false&libraries=places&language=ar&key=AIzaSyA9_ve_oT3ynCaAF8Ji4oBuDjOhWEHE92U'>

    </script>

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
    <script>
        var input = document.querySelector("#phone");
        window.intlTelInput(input, ({
            // options here
        }));
        document.getElementById('phone').value = '';
    </script>
@endsection
