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
                    <h4 class="card-title">{{awtTrans('تعديل مقدم الخدمة')}}</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form  method="POST" action="{{route('admin.providers.update' , ['id' => $row->id])}}" class="store form-horizontal" novalidate>
                            @csrf
                            @method('PUT')
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="imgMontg col-12 text-center">
                                            <div class="dropBox">
                                                <div class="textCenter">
                                                    <div class="imagesUploadBlock">
                                                        <label class="uploadImg">
                                                            <span><i class="feather icon-image"></i></span>
                                                            <input type="file" accept="image/*" name="avatar" class="imageUploader">
                                                        </label>
                                                        <div class="uploadedBlock">
                                                            <img src="{{$row->avatar}}">
                                                            <button class="close"><i class="la la-times"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{awtTrans('الاسم')}}</label>
                                            <div class="controls">
                                                <input type="text" name="name" value="{{$row->name}}" class="form-control" placeholder="{{awtTrans('اكتب الاسم')}}" required data-validation-required-message="{{awtTrans('هذا الحقل مطلوب')}}" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{awtTrans('رقم الهاتف')}}</label>
                                            <div class="controls">
                                                <input type="number" name="phone" value="{{$row->phone}}" class="form-control" placeholder="{{awtTrans('اكتب رقم الهاتف')}}" required data-validation-required-message="{{awtTrans('هذا الحقل مطلوب')}}" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{awtTrans('صورة الهوية')}}</label>
                                            <div class="controls">
                                                <a href="{{url('storage/images/id_images/'. $row->id_image)}}" target="_blank"> صورة الهوية</a>
                                                <input type="file" name="id_image" class="form-control" placeholder="{{awtTrans(' صورة الهوية')}}"  >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{awtTrans('رقم الهوية')}}</label>
                                            <div class="controls">
                                                <input type="text" name="id_number" value="{{$row->id_number}}" class="form-control" placeholder="{{awtTrans('رقم الهوية')}}" required data-validation-required-message="{{awtTrans('هذا الحقل مطلوب')}}" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{awtTrans('البريد الالكتروني')}}</label>
                                            <div class="controls">
                                                <input type="email" name="email" value="{{$row->email}}" class="form-control" placeholder="{{awtTrans('اكتب البريد الالكتروني')}}" required data-validation-required-message="{{awtTrans('هذا الحقل مطلوب')}}" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{awtTrans('كلمة السر')}}</label>
                                            <div class="controls">
                                                <input type="password" name="password" class="form-control"  placeholder="*******">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{awtTrans('العنوان')}}</label>
                                            <div class="controls">
                                                <input type="text" disabled name="" value="{{$row->address}}" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{awtTrans('تفعيل مقدم الخدمة')}}</label>
                                            <div class="controls">
                                                <select name="activation_admin" class="select2 form-control" required data-validation-required-message="{{awtTrans('هذا الحقل مطلوب')}}" >
                                                    <option {{$row->activation_admin == 1 ? 'selected' : ''}} value="1">{{awtTrans('مفعل')}}</option>
                                                    <option {{$row->activation_admin == 0 ? 'selected' : ''}} value="0">{{awtTrans('غير مفعل')}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{awtTrans('المدينة')}}</label>
                                            <div class="controls">
                                                <select name="city_id" class="select2 form-control" required data-validation-required-message="{{awtTrans('هذا الحقل مطلوب')}}" >
                                                   @foreach($cities as $city)
                                                    <option {{$row->city_id == $city->id ? 'selected' : ''}} value="{{$city->id}}">
                                                        {{$city->name}}
                                                    </option>
                                                   @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{awtTrans('الصلاحية')}}</label>
                                            <div class="controls">
                                                <select name="block" class="select2 form-control" required data-validation-required-message="{{awtTrans('هذا الحقل مطلوب')}}" >
                                                    <option value>{{awtTrans('اختر حالة الحظر')}}</option>
                                                    <option {{$row->block == 1 ? 'selected' : ''}} value="1">{{awtTrans('محظور')}}</option>
                                                    <option {{$row->block == 0 ? 'selected' : ''}} value="0">{{awtTrans('غير محظور')}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12" style="clear: both">
                                        <h6 >العنوان علي الخريطة</h6>

                                        <div class="form-group  col-md-12">
                                            <div id="map" style="width: 100%;height:250px;"></div>
                                            <input type="hidden" id="resultAddress" name="address" class="form-control"
                                                   placeholder=" تفاصيل العنوان   " readonly>


                                            <input type="hidden" id="lat" value="{{$row->lat}}" name="lat" class="form-control">
                                            <input type="hidden" id="lng" value="{{$row->lng}}" name="lng" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-12 d-flex justify-content-center mt-3">
                                        <button type="submit" class="btn btn-primary mr-1 mb-1 submit_button">{{awtTrans('تعديل')}}</button>
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

@endsection
