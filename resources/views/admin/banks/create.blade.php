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
                    <h4 class="card-title">{{awtTrans('اضافه بنوك ')}}</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form  method="POST" action="{{route('admin.banks.store')}}" class="store form-horizontal" novalidate>
                            @csrf
                            <div class="form-body">
                                <div class="row">

                                    <div class="col-12">
                                    <div class="imgMontg col-12 text-center">
                                        <div class="dropBox">
                                            <div class="textCenter">
                                                <div class="imagesUploadBlock">
                                                    <label class="uploadImg">
                                                        <span><i class="feather icon-image"></i></span>
                                                        <input type="file" accept="image/*" name="image" class="imageUploader">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                  </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{awtTrans('اسم البنك')}}</label>
                                            <div class="controls">
                                                <input type="text" name="bank_name" class="form-control" placeholder="{{awtTrans('اسم البنك')}}" required data-validation-required-message="{{awtTrans('هذا الحقل مطلوب')}}" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{awtTrans('اسم الحساب')}}</label>
                                            <div class="controls">
                                                <input type="text" name="account_name" class="form-control" placeholder="{{awtTrans('اسم الحساب')}}" required data-validation-required-message="{{awtTrans('هذا الحقل مطلوب')}}" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{awtTrans('رقم الحساب')}}</label>
                                            <div class="controls">
                                                <input type="number" name="account_number" class="form-control" placeholder="{{awtTrans('رقم الحساب')}}" required data-validation-required-message="{{awtTrans('هذا الحقل مطلوب')}}" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{awtTrans('رقم الايبان')}}</label>
                                            <div class="controls">
                                                <input type="number" name="iban_number" class="form-control" placeholder="{{awtTrans('رقم الايبان')}}" required data-validation-required-message="{{awtTrans('هذا الحقل مطلوب')}}" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 d-flex justify-content-center mt-3">
                                        <button type="submit" class="btn btn-primary mr-1 mb-1 submit_button">{{awtTrans('اضافة')}}</button>
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

    {{-- submit add form script --}}
        @include('admin.shared.submitAddForm')
    {{-- submit add form script --}}

@endsection
