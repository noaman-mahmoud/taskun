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
                    <h4 class="card-title">{{awtTrans('تفاصيل الحجز ')}}</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form  method="POST" action="{{route('admin.reservations.update' , ['id' => $row->id])}}" class="store form-horizontal" novalidate>
                            @csrf
                            @method('PUT')
                            <div class="form-body">
                                <div class="row">

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{awtTrans('اسم المستخدم')}}</label>
                                            <div class="controls">
                                                <input type="text" name="name_ar" value="{{$row->user->name}}" class="form-control" disabled >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{awtTrans('هاتف المستخدم')}}</label>
                                            <div class="controls">
                                                <input type="text" name="name_ar" value="{{$row->user->phone}}" class="form-control" disabled >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{awtTrans('الاسم الاول')}}</label>
                                            <div class="controls">
                                                <input type="text" name="name_ar" value="{{$row->first_name}}" class="form-control" disabled >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{awtTrans('اسم الاب')}}</label>
                                            <div class="controls">
                                                <input type="text" name="name_ar" value="{{$row->father_name}}" class="form-control" disabled >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{awtTrans('اسم العائلة')}}</label>
                                            <div class="controls">
                                                <input type="text" name="name_ar" value="{{$row->last_name}}" class="form-control" disabled >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{awtTrans('الهاتف')}}</label>
                                            <div class="controls">
                                                <input type="text" name="name_ar" value="{{$row->phone}}" class="form-control" disabled >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{awtTrans('رقم الهوية')}}</label>
                                            <div class="controls">
                                                <input type="text" name="name_ar" value="{{$row->id_number}}" class="form-control" disabled >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{awtTrans('العقار')}}</label>
                                            <div class="controls">
                                                <input type="text" name="name_ar" value="{{$row->estate->name}}" class="form-control" disabled >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{awtTrans('تاريخ بداية الحجز')}}</label>
                                            <div class="controls">
                                                <input type="text" name="name_ar" value="{{$row->start_date}}" class="form-control" disabled >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{awtTrans('وقت بداية الحجز')}}</label>
                                            <div class="controls">
                                                <input type="text" name="name_ar" value="{{$row->start_time}}" class="form-control" disabled >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{awtTrans('تاريخ نهاية الحجز')}}</label>
                                            <div class="controls">
                                                <input type="text" name="name_ar" value="{{$row->end_date}}" class="form-control" disabled >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{awtTrans('وقت نهاية الحجز')}}</label>
                                            <div class="controls">
                                                <input type="text" name="name_ar" value="{{$row->end_time}}" class="form-control" disabled >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{awtTrans('عدد الايام')}}</label>
                                            <div class="controls">
                                                <input type="text" name="name_ar" value="{{$row->days}}" class="form-control" disabled >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{awtTrans('سعر حجز اليوم')}}</label>
                                            <div class="controls">
                                                <input type="text" name="name_ar" value="{{$row->price}}" class="form-control" disabled >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">
                                                {{awtTrans('اسم مقدم الخدمة')}}
                                            </label>
                                            <div class="controls">
                                                <input type="text" name="name_ar" value="{{$row->provider->phone}}" class="form-control" disabled >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{awtTrans('هاتف مقدم الخدمة')}}</label>
                                            <div class="controls">
                                                <input type="text" name="name_ar" value="{{$row->provider->phone}}" class="form-control" disabled >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column" style="color:red;font-weight:bold">
                                                {{awtTrans('الاجمالي')}}
                                            </label>
                                            <div class="controls">
                                                <input type="text" name="name_ar" value="{{$row->total}}" class="form-control" disabled >
                                            </div>
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

@endsection
