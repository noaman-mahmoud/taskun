@extends('site.layouts.master')
@section('content')
<section class="content">
    <!-- banner- section -->
    <div class="banner-section banner-show" style="background-image: url({{url('website/img/banner-home.png')}});">
        <div class="container">
            <div class="info">
                <p class="title">{{awtTrans('اضافة وحدة سكنية')}}</p>
            </div>
        </div>
    </div>

    <div class="form-section">
        <div class="container">
            <form action="{{url('post-add-unit')}}" class="main-form" method="post" enctype="multipart/form-data" id="AddUnit">
                @csrf
                <div class="form-group">
                    <label for="" class="label">{{awtTrans('اختيار الدور')}}</label>
                    <select name="role" id="" class="select">
                      @for($i = 1; $i <= $data->number_roles ; $i ++ )
                        <option value="{{$i}}"> {{ awtTrans('الدور') }} {{$i}} </option>
                      @endfor
                    </select>
                </div>

                <div class="form-group">
                    <label for="" class="label">{{awtTrans('نوع الوحده')}}</label>
                    <select name="housing_type_id" id="" class="select">
                      @foreach($housing as $house)
                        <option value="{{$house->id}}">{{$house->name}}</option>
                       @endforeach
                    </select>
                </div>

                <span class="info-unit">{{awtTrans('معلومات الوحدة')}}</span>

                <div class="row">

                    <div class="col-12 col-md-6 col-sm-12">
                        <div class="form-group input-text">
                            <label for="" class="label">{{awtTrans('أسم المستأجر')}}</label>
                            <input type="text" placeholder="{{awtTrans('أسم المستأجر')}}" name="tenant_name">
                            <input type="hidden" name="property_id" value="{{$data->id}}">
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-sm-12">
                        <div class="form-group input-text">
                            <label for="" class="label">{{awtTrans('رقم العقد')}}</label>
                            <input type="text" placeholder="{{awtTrans('رقم العقد')}}" name="contract_number" lang="en">
                        </div>
                    </div>
                </div>

                <div class="phone-input form-group input-number">
                    <label for="" class="label">{{awtTrans('رقم الجوال')}}</label>
                    <input type="number" id="phone" placeholder="{{awtTrans('رقم الجوال')}}" name="phone" lang="en">
                </div>

                <div class="phone-input form-group input-number">
                    <label for="" class="label">{{awtTrans('رقم الواتس اب')}}</label>
                    <input type="number" id="phone-2" placeholder="{{awtTrans('رقم الواتس اب')}}" name="whatsapp" lang="en">
                </div>

                <div class="row">

                    <div class="col-12 col-md-6 col-sm-12">
                        <div class="form-group input-text">
                            <label for="" class="label">{{awtTrans('بدايه العقد')}}</label>
                            <input type="date" placeholder="01\ 12 \ 2022" name="contract_from_date">
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-sm-12">
                        <div class="form-group input-text">
                            <label for="" class="label">{{awtTrans('نهايه العقد')}}</label>
                            <input type="date" placeholder="01\ 12 \ 2023" name="contract_to_date">
                        </div>
                    </div>

                </div>

                <div class="form-group input-text with-hint">
                    <label for="" class="label">{{awtTrans('مده العقد')}}</label>
                    <input type="number" placeholder="2" name="duration_contract" lang="en">
                    <span class="hint cl-green">{{awtTrans('سنة')}}</span>
                </div>

                <div class="form-group input-text with-hint">
                    <label for="" class="label">{{awtTrans('قيمه الأيجار')}}</label>
                    <input type="text" placeholder="2000" name="rent">
                    <span class="hint cl-green">{{awtTrans('ريال شهريا')}}</span>
                </div>

                <div class="form-group input-text">
                    <label for="" class="label">{{awtTrans('نظام الدفع')}}</label>
                    <input type="text" placeholder="{{awtTrans('سنوي')}}" name="payment_system">
                </div>

                <div class="row">
                    <div class="col-12 col-md-6 col-sm-12">
                        <div class="img-uploader form-group">
                            <label class="label">
                                {{awtTrans('فاتوره الكهرباء (مطلوبة)')}}
                            </label>
                            <label class="upload-label">
                                <input type="file" class="d-none" accept="image/*" name="electricity_bill" required>
                                <span class="input">
                                </span>
                                <i class="fas fa-camera icon"></i>
                            </label>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-sm-12">
                        <div class="img-uploader form-group">
                            <label class="label">
                                {{awtTrans('فاتورة المياة (مطلوبة)')}}
                            </label>
                            <label class="upload-label">
                                <input type="file" class="d-none" name="water_bill" required>
                                <span class="input">
                                </span>
                                <i class="fas fa-camera icon"></i>
                            </label>
                        </div>
                    </div>

                </div>
                @if(setting()['send_message'] == 1)
                  <div class="form-group input-text input-area">
                    <label for="" class="label">{{awtTrans('نص الرسالة')}}</label>
                    <input type="text" name="message" placeholder="
                    {{awtTrans('نفيدكم أن عقد الايجار رقم 1 يحل القسط رقم 6611 بتاريخ  20 سبتمبر 2021 وقدره  1200 ريال ولكم الشكر')}}">
                </div>
                  <div class="form-group mult-radio-btn">
                    <div class="row section-radio">
                        <span class="label-radio">{{awtTrans('عدد الرسايل')}}</span>
                        <div class="col-6 col-md-3">
                            <label class="radio-btn">
                                <input type="radio" name="number_messages" value="1" class="radio-check d-none" placeholder="" checked>
                                <div class="check-inner">
                                    <span class="box"></span>
                                    <p class="hint">{{awtTrans('مره')}}</p>
                                </div>
                            </label>
                        </div>
                        <div class="col-6 col-md-3">
                            <label class="radio-btn">
                                <input type="radio" name="number_messages" value="2" class="radio-check d-none" placeholder="">
                                <div class="check-inner">
                                    <span class="box"></span>
                                    <p class="hint">{{awtTrans('مرتين')}}</p>
                                </div>
                            </label>

                        </div>
                        <div class="col-6 col-md-3">
                            <label class="radio-btn">
                                <input type="radio" name="number_messages" value="3" class="radio-check d-none" placeholder="">
                                <div class="check-inner">
                                    <span class="box"></span>
                                    <p class="hint">{{awtTrans('3 مرات')}}</p>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
                @endif

                <button type="submit" class="continue-btn bg-green">{{awtTrans('تأكيد')}}</button>
            </form>

        </div>
    </div>
</section>
@endsection

@section('scripts')
    {!! jsValidation('Api\Management\AddUnit', '#AddUnit') !!}
    <script>
        new WOW().init();
        var input = document.querySelector("#phone");
        window.intlTelInput(input, ({
            // options here
        }));
        var input = document.querySelector("#phone-2");
        window.intlTelInput(input, ({
            // options here
        }));
        document.getElementById('phone').value = '';
    </script>

    <script>
        $(document).on('change', '.img-uploader input', function (event) {
            $(this).parents('.img-uploader').find('.upload-preview').remove();
            if(event.target.files.length > 0) {
                $(this).parents('.img-uploader').append(

                    '<div class="upload-preview"><img src="' +
                    URL.createObjectURL(event.target.files[0]) +
                    '" alt=""><i class="remove-appendedd">x</i></div>'
                );
            }
        });

        // remove-appendedd
        $(document).on('click', '.remove-appendedd', function () {
            event.preventDefault();
            $(this).parents('.img-uploader').find('input').val('');
            $(this).parent().remove();
        })
    </script>
@endsection
