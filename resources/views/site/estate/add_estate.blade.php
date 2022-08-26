@extends('site.layouts.master')

@section('content')

<section class="content orange">

    <!-- banner- section -->
    <div class="banner-section banner-show" style="background-image: url({{url('website/img/banner-home.png')}});">
        <div class="container">
            <div class="info">
                <p class="title">{{awtTrans('اضافه اعلان')}}</p>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="progress-form">
            <div class="title-show cl-blue">
                <span class="bg-blue"></span>
                {{awtTrans('المعلومات الاساسية')}}
            </div>
            <div class="pr-bar">
                <span class="hint">1/5</span>
                <div role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="50" style="--value:10">
                </div>
            </div>
        </div>
    </div>

    <div class="form-section">
        <div class="container">

            <form action="{{url('post-add-estate')}}" class="main-form" method="post" id="AddEstate" enctype="multipart/form-data">
                @csrf
                <!-- section - preview -->
                <div class="preview-section">

                    <div class="profile-img-upload main-img-ad">
                        <label class="inner">
                            <input type="file" class="d-none" name="images[]">
                            <img src="{{asset('website/img/picture_add.png')}}"  alt="">
                            {{awtTrans('صوره خارجيه')}}
                        </label>
                    </div>

                    <div class="main-imgs-ad">

                        <div class="profile-img-upload single-img-ad">
                            <label class="inner">
                                <input type="file" class="d-none" name="images[]">
                                <img src="{{asset('website/img/plus-img.png')}}" alt="">
                            </label>
                        </div>

                        <div class="profile-img-upload single-img-ad">
                            <label class="inner">
                                <input type="file" class="d-none" name="images[]">
                                <img src="{{asset('website/img/plus-img.png')}}" alt="">
                            </label>
                        </div>

                        <div class="profile-img-upload single-img-ad">
                            <label class="inner">
                                <input type="file" class="d-none" name="images[]">
                                <img src="{{asset('website/img/plus-img.png')}}" alt="">
                            </label>
                        </div>

                        <div class="profile-img-upload single-img-ad">
                            <label class="inner">
                                <input type="file" class="d-none" name="images[]">
                                <img src="{{asset('website/img/plus-img.png')}}" alt="">
                            </label>
                        </div>

                        <div class="profile-img-upload single-img-ad">
                            <label class="inner">
                                <input type="file" class="d-none" name="images[]">
                                <img src="{{asset('website/img/plus-img.png')}}" alt="">
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="label">{{awtTrans('نوع البيع')}}</label>
                    <select name="type" id="" class="select">
                        <option value="sell">{{awtTrans('بيع')}}</option>
                        <option value="rent">{{awtTrans('ايجار')}}</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="" class="label">{{awtTrans('المدينه')}}</label>
                    <select name="city_id" id="" class="select">
                       @foreach($cities as $city)
                          <option value="{{$city->id}}">{{$city->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group location-input location-with-icon">
                    <label for="" class="label">{{awtTrans('الموقع')}}</label>
                    <input type="text" readonly id="address" name="address" class="bg-transparent  form-control" data-toggle="modal"
                           data-target="#staticBackdrop">
                    <i class="fas fa-map-marker-alt"></i>
                    <input type="hidden" name="lat" id="lat" value="24.774265">
                    <input type="hidden" name="lng" id="lng" value="46.738586">
                </div>


                <div class="form-group">
                    <label for="" class="label">{{awtTrans('نوع العقار')}}</label>
                    <select name="category_id" id="" class="select">
                      @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                       @endforeach
                    </select>
                </div>

                <div class="form-group input-text">
                    <label for="" class="label">{{awtTrans('عنوان الاعلان')}}</label>
                    <input type="text" name="title" placeholder="{{awtTrans('فيلا كبيره')}}">
                </div>

                <div class="form-group">
                    <label for="" class="label">{{awtTrans('فئه العقار')}}</label>
                    <select name="estate_category_id" id="" class="select">
                      @foreach($estateCategories as $estateCategory)
                        <option value="{{$estateCategory->id}}">{{$estateCategory->name}}</option>
                      @endforeach
                    </select>
                </div>

                <div class="form-group input-text">
                    <label for="" class="label">{{awtTrans('رقم التفويض')}}</label>
                    <input type="number"  name="entrustment" placeholder="12345644" lang="en">
                </div>

                <div class="form-group input-select">
                    <label for="" class="label">{{awtTrans('نوع الاعلان')}}</label>
                    <select name="sale_type" id="" class="select">
                        <option value="som">{{awtTrans('سوم')}}</option>
                        <option value="limit" data-attr="real-estate-office">{{awtTrans('حد')}}</option>
                    </select>
                </div>

                <div class="form-group input-text with-hint input-estate-office d-none">
                    <label for="" class="label">{{awtTrans('السعر')}}</label>
                    <input type="number" placeholder="10000" name="price" lang="en">
                    <span class="hint">{{awtTrans('ريال')}}</span>
                </div>

                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group input-text">
                            <label for="" class="label">{{awtTrans('أسم الحي')}}</label>
                            <input type="text" name="neighborhood" placeholder="{{awtTrans('حي الزهور')}}">
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="form-group input-text with-hint">
                            <label for="" class="label">{{awtTrans('رقم المخطط')}}</label>
                            <input type="number" placeholder="46687" name="planned" lang="en">
                            <span class="hint">{{awtTrans('(اختياري)')}}</span>
                        </div>
                    </div>

                </div>

                <button type="submit"  class="continue-btn">{{awtTrans('اكمال')}}</button>
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
    {!! jsValidation('Api\Estate\AddEstate', '#AddEstate') !!}
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
    <script>
        $(document).on('change', '.profile-img-upload input', function (event) {
            if (event.target.files.length > 0) {
                $(this).siblings('img').attr('src', URL.createObjectURL(event.target.files[0]));
                $(this).siblings('img').addClass('single-img');
            } else {
                $(this).siblings('img').attr('src', '{{url('website/img/plus-img.png')}}');
                $(this).siblings('img').removeClass('single-img');
            }
        });

        $(document).on("click", ".remove", function () {
            $(this).parent().find(".prev").remove()
            $("#image").val("")
            $(this).remove()
        });
    </script>
@endsection
