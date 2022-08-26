@extends('site.layouts.master')
@section('content')
<section class="content">
    <!-- banner- section -->
    <div class="banner-section banner-show" style="background-image: url({{url('website/img/banner-home.png')}});">
        <div class="container">
            <div class="info">
                <p class="title">{{awtTrans('بيانات المستأجر')}}</p>
            </div>
        </div>
    </div>

    <div class="info-Ad for-tenant">
      <form method="post" action="{{url('post-edit-unit')}}" enctype="multipart/form-data">
        @csrf

        <div class="info-product info-with-bgc">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-6 col-sm-12">
                        <div class="box mrg-box">
                            <p class="hint hint-mrg">{{awtTrans('أسم المستخدم')}}</p>
                            <p class="hint-2 cl-green">{{$data['tenant_name']}}</p>
                            <input value="{{$data['id']}}" name="unit_id" type="hidden">
                        </div>
                    </div>

                    <div class="col-12 col-lg-6 col-sm-12">
                        <div class="box">
                            <p class="hint hint-mrg">{{awtTrans('رقم العقد')}}</p>
                            <p class="hint-2 cl-green">{{$data['contract_number']}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="info-product">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-6 col-sm-12">
                        <div class="box mrg-box">
                            <p class="hint hint-mrg">{{awtTrans('رقم الواتساب')}}</p>
                            <p class="hint-2 cl-green">{{$data['whatsapp']}}</p>
                        </div>
                    </div>

                    <div class="col-12 col-lg-6 col-sm-12">
                        <div class="box">
                            <p class="hint hint-mrg">{{awtTrans('رقم الجوال')}}</p>
                            <p class="hint-2 cl-green">{{$data['phone']}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="info-product info-with-bgc">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-6 col-sm-12">
                        <div class="box mrg-box">
                            <p class="hint hint-mrg">{{awtTrans('بدايه تاريخ العقد')}}</p>
                            <p class="hint-2 cl-green">{{$data['contract_from_date']}}</p>
                        </div>
                    </div>

                    <div class="col-12 col-lg-6 col-sm-12">
                        <div class="box">
                            <p class="hint hint-mrg">{{awtTrans('نهاية تاريخ العقد')}}</p>
                            <p class="hint-2 cl-green">{{$data['contract_to_date']}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="info-product">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-6 col-sm-12">
                        <div class="box mrg-box">
                            <p class="hint hint-mrg">{{awtTrans('مده العقد')}}</p>
                            <p class="hint-2 cl-green">{{$data['duration_contract']}}</p>
                        </div>
                    </div>

                    <div class="col-12 col-lg-6 col-sm-12">
                        <div class="box">
                            <p class="hint hint-mrg">{{awtTrans('قيمه الأيجار')}}</p>
                            <p class="hint-2 cl-green">{{$data['rent']}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="electric-img-section">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-6 col-sm-12">
                        <div class="item">
                            <div class="fancy-img">
                                <img src="{{$data['electricity_bill']}}" class="img" alt="">
                                <a href="{{$data['electricity_bill']}}" data-fancybox="gallery" class="icon-img">
                                    <i class="fas fa-expand-arrows-alt"></i>
                                </a>
                                <p class="hint">{{awtTrans('فاتوره الكهرباء')}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-sm-12">
                        <div class="item">
                            <div class="fancy-img">
                                <img src="{{$data['water_bill']}}" class="img" alt="">
                                <a href="{{$data['water_bill']}}" data-fancybox="gallery" class="icon-img">
                                    <i class="fas fa-expand-arrows-alt"></i>
                                </a>
                                <p class="hint">{{awtTrans('فاتوره المياه')}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tenant-title info-with-bgc">
            <div class="container">
                <div class="title-box">
                    <p class="title">{{awtTrans('نص الرسالة')}}</p>
                    <p class="hint">{{$data['message']}}</p>
                </div>
            </div>
        </div>

        <div class="info-product">
            <div class="container">
                <div class="row">
{{--                    <div class="col-12 col-lg-6 col-sm-12">--}}
{{--                        <div class="box mrg-box">--}}
{{--                            <p class="hint">تاريخ الأرسال</p>--}}
{{--                            <p class="hint-2 cl-green">نفس اليوم</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    <div class="col-12 col-lg-6 col-sm-12">
                        <div class="box">
                            <p class="hint">{{awtTrans('عدد الرسايل')}}</p>
                            <p class="hint-2 cl-green">{{$data['number_messages']}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">

            <table class="order-status-table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{awtTrans('يبدء من')}}</th>
                    <th>{{awtTrans('تم الأستلام')}}</th>
                    <th>{{awtTrans('التحصيل')}}</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($data['dates'] as $date)
                    <tr>
                        <td>{{$date['id']}}</td>
                        <td>{{$date['date']}}</td>
                        <td>
                            <label class="radio-btn">
                                <input type="checkbox" name="selected_dates[]" value="{{$date['select']}}"
                                     class="radio-check d-none" {{$date['checked'] == 1 ? 'checked' : ''}}>
                                <div class="check-inner">
                                    <i class="fas fa-check"></i>
                                </div>
                            </label>
                        </td>
                        <td>{{ $date['checked'] == 1 ? $date['select'] : ''}}</td>
                    </tr>
                  @endforeach
                </tbody>
            </table>

            <button type="submit" class="phone-cal-btn green">
                {{awtTrans('حفظ التعديلات')}}
            </button>
        </div>

      </form>

      <form method="post" action="{{url('delete-unit')}}">
            @csrf
          <input type="hidden" name="unit_id" value="{{$data['id']}}">

          <button type="submit" class="phone-cal-btn gray">{{awtTrans('حذف')}}</button>
      </form>

      <div class="container">
            <div class="contact-btns contact-btns-bg">
                <a href="tel:{{$data['phone']}}" class="phone-ct active">
                    <i class="fas fa-phone-alt"></i>
                    {{awtTrans('الأتصال علي الهاتف')}}
                </a>
                <a href="https://wa.me/{{$data['whatsapp']}}" class="watts-ct cl-green">
                    <img src="{{asset('website/img/whatsapp (3).png')}}" alt="">
                    {{awtTrans('بر الواتساب')}}
                </a>
            </div>
       </div>
    </div>
</section>
@endsection
