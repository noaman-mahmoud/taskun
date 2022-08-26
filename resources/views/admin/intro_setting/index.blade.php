@extends('admin.layout.master')

@section('content')

<div class="content-body">
  <!-- account setting page start -->
  <section id="page-account-settings">
      <div class="row">
          <!-- left menu section -->
          <div class="col-md-3 mb-2 mb-md-0">
              <ul class="nav nav-pills flex-column mt-md-0 mt-1">

                  <li class="nav-item">
                      <a class="nav-link d-flex py-75 active" id="account-pill-main" data-toggle="pill" href="#account-vertical-main" aria-expanded="true">
                          <i class="feather icon-globe mr-50 font-medium-3"></i>
                          {{awtTrans('إعدادات التطبيق')}}
                      </a>
                  </li>
                  <li class="nav-item" style="margin-top: 3px">
                      <a class="nav-link d-flex py-75" id="account-pill-texts" data-toggle="pill" href="#account-vertical-texts" aria-expanded="false">
                          <i class="feather icon-edit mr-50 font-medium-3"></i>
                          {{awtTrans('نصوص متكرره')}}
                      </a>
                  </li>
                  <li class="nav-item" style="margin-top: 3px">
                      <a class="nav-link d-flex py-75" id="account-pill-about" data-toggle="pill" href="#account-vertical-about" aria-expanded="false">
                          <i class="feather icon-file mr-50 font-medium-3"></i>
                          {{awtTrans('عن التطبيق')}}
                      </a>
                  </li>

              </ul>
          </div>
          <!-- right content section -->
          <div class="col-md-9">
              <div class="card">
                  <div class="card-content">
                      <div class="card-body">
                          <div class="tab-content">

                              <div role="tabpanel" class="tab-pane active" id="account-vertical-main" aria-labelledby="account-pill-main" aria-expanded="true">
                                <form action="{{route('admin.settings.update')}}" method="post" enctype="multipart/form-data">
                                  @method('put')
                                  @csrf
                                <div class="row">
                                  <div class="col-6">
                                        <div class="form-group">
                                            <div class="controls">
                                                <label for="account-name">{{awtTrans('اسم الموقع التعريفي بالعربي')}}</label>
                                                <input type="text" class="form-control" name="intro_name_ar" id="account-name" placeholder="{{awtTrans('اسم الموقع التعريفي بالعربي')}}" value="{{$data['intro_name_ar']}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <div class="controls">
                                                <label for="account-name">{{awtTrans('اسم الموقع التعريفي بالانجليزيه')}}</label>
                                                <input type="text" class="form-control" name="intro_name_en" id="account-name" placeholder="{{awtTrans('اسم الموقع التعريفي بالانجليزيه')}}" value="{{$data['intro_name_en']}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <div class="controls">
                                                <label for="account-name">{{awtTrans('البريد الالكتروني')}}</label>
                                                <input type="text" class="form-control" name="intro_email" id="account-name" placeholder="{{awtTrans('البريد الالكتروني')}}" value="{{$data['intro_email']}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <div class="controls">
                                                <label for="account-name">{{awtTrans('رقم الهاتف')}}</label>
                                                <input type="text" class="form-control" name="intro_phone" id="account-name" placeholder="{{awtTrans('رقم الهاتف')}}" value="{{$data['intro_phone']}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <div class="controls">
                                                <label for="account-name">{{awtTrans('العنوان')}}</label>
                                                <input type="text" class="form-control" name="intro_address" id="account-name" placeholder="{{awtTrans('العنوان')}}" value="{{$data['intro_address']}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                      <div class="row">
                                          <div class="col-4">
                                              <div class="form-group">
                                                  <div class="controls">
                                                      <label for="account-name">{{awtTrans('لون الموقع الرئيسي')}}</label>
                                                      <input type="color" class="form-control" name="color" id="account-name" placeholder="{{awtTrans('لون الموقع الرئيسي')}}" value="{{$data['color']}}">
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="col-4">
                                              <div class="form-group">
                                                  <div class="controls">
                                                      <label for="account-name">{{awtTrans('لون  ال buttons')}}</label>
                                                      <input type="color" class="form-control" name="buttons_color" id="account-name" placeholder="{{awtTrans('لون  ال buttons')}}" value="{{$data['buttons_color']}}">
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="col-4">
                                              <div class="form-group">
                                                  <div class="controls">
                                                      <label for="account-name">{{awtTrans('لون  ال hover')}}</label>
                                                      <input type="color" class="form-control" name="hover_color" id="account-name" placeholder="{{awtTrans('لون  ال hover')}}" value="{{$data['hover_color']}}">
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                    </div>
                                    <div class="col-12">
                                      <div class="row">

                                        <div class="imgMontg col-2 text-center">
                                            <div class="dropBox">
                                                <div class="textCenter d-flex flex-lg-column">
                                                    <div class="imagesUploadBlock">
                                                        <label class="uploadImg">
                                                            <span><i class="feather icon-image"></i></span>
                                                            <input type="file" accept="image/*" name="intro_logo" class="imageUploader">
                                                        </label>
                                                        <div class="uploadedBlock">
                                                            <img src="{{url('storage/images/settings/intro_logo.png')}}">
                                                            <button class="close"><i class="feather icon-trash-2"></i></button>
                                                        </div>
                                                      </div>
                                                      <span>{{awtTrans('صورة لوجو الموقع التعريفي')}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="imgMontg col-2 text-center">
                                            <div class="dropBox">
                                                <div class="textCenter d-flex flex-lg-column">
                                                    <div class="imagesUploadBlock">
                                                        <label class="uploadImg">
                                                            <span><i class="feather icon-image"></i></span>
                                                            <input type="file" accept="image/*" name="intro_loader" class="imageUploader">
                                                        </label>
                                                        <div class="uploadedBlock">
                                                            <img src="{{url('/storage/images/settings/intro_loader.png')}}">
                                                            <button class="close"><i class="feather icon-trash-2"></i></button>
                                                        </div>
                                                      </div>
                                                      <span>{{awtTrans('صورة ال  loader ')}}</span>
                                                </div>
                                            </div>
                                        </div>
                                      </div>

                                    </div>
                                    <div class="col-12 d-flex justify-content-center mt-3">
                                        <button type="submit" class="btn btn-primary mr-1 mb-1 submit_button">{{awtTrans('حفظ التغييرات')}}</button>
                                        <a href="{{ url()->previous() }}" type="reset" class="btn btn-outline-warning mr-1 mb-1">{{awtTrans(' رجوع ')}}</a>
                                    </div>
                                </div>
                                </form>
                              </div>

                              <div role="tabpanel" class="tab-pane" id="account-vertical-texts" aria-labelledby="account-pill-texts" aria-expanded="false">
                                <form action="{{route('admin.settings.update')}}" method="post" enctype="multipart/form-data">
                                    @method('put')
                                    @csrf

                                    <div class="row">
                                      <div class="col-12">
                                          <div class="form-group">
                                              <div class="controls">
                                                  <label for="account-name">{{awtTrans('عنوان قسم خدماتنا بالعربية')}}</label>
                                                  <textarea class="form-control" name="services_text_ar" id="" cols="30" rows="10" placeholder="{{awtTrans('عنوان قسم خدماتنا بالعربية')}}">{{$data['services_text_ar']}}</textarea>
                                              </div>
                                          </div>
                                      </div>

                                      <div class="col-12">
                                          <div class="form-group">
                                              <div class="controls">
                                                  <label for="account-name">{{awtTrans('عنوان قسم خدماتنا بالانجليزية')}}</label>
                                                  <textarea class="form-control" name="services_text_en" id="" cols="30" rows="10" placeholder="{{awtTrans('عنوان قسم خدماتنا بالانجليزية')}}">{{$data['services_text_en']}}</textarea>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="col-12">
                                          <div class="form-group">
                                              <div class="controls">
                                                  <label for="account-name">{{awtTrans('عنوان قسم كيف يعمل الموقع بالعربية')}}</label>
                                                  <textarea class="form-control" name="how_work_text_ar" id="" cols="30" rows="10" placeholder="{{awtTrans('عنوان قسم كيف يعمل الموقع بالعربية')}}">{{$data['how_work_text_ar']}}</textarea>
                                              </div>
                                          </div>
                                      </div>

                                      <div class="col-12">
                                          <div class="form-group">
                                              <div class="controls">
                                                  <label for="account-name">{{awtTrans('عنوان قسم كيف يعمل الموقع بالعربية')}}</label>
                                                  <textarea class="form-control" name="how_work_text_ar" id="" cols="30" rows="10" placeholder="{{awtTrans('عنوان قسم كيف يعمل الموقع بالعربية')}}">{{$data['how_work_text_ar']}}</textarea>
                                              </div>
                                          </div>
                                      </div>

                                      <div class="col-12">
                                          <div class="form-group">
                                              <div class="controls">
                                                  <label for="account-name">{{awtTrans('عنوان قسم كيف يعمل الموقع  بالانجليزية')}}</label>
                                                  <textarea class="form-control" name="how_work_text_en" id="" cols="30" rows="10" placeholder="{{awtTrans('عنوان قسم كيف يعمل الموقع  بالانجليزية')}}">{{$data['how_work_text_en']}}</textarea>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="col-12">
                                          <div class="form-group">
                                              <div class="controls">
                                                  <label for="account-name">{{awtTrans('عنوان قسم الاسئلة الشائعه بالعربية')}}</label>
                                                  <textarea class="form-control" name="fqs_text_ar" id="" cols="30" rows="10" placeholder="{{awtTrans('عنوان قسم الاسئلة الشائعه بالعربية')}}">{{$data['fqs_text_ar']}}</textarea>
                                              </div>
                                          </div>
                                      </div>

                                      <div class="col-12">
                                          <div class="form-group">
                                              <div class="controls">
                                                  <label for="account-name">{{awtTrans('عنوان قسم الاسئلة الشائعه  بالانجليزية')}}</label>
                                                  <textarea class="form-control" name="fqs_text_en" id="" cols="30" rows="10" placeholder="{{awtTrans('عنوان قسم الاسئلة الشائعه  بالانجليزية')}}">{{$data['fqs_text_en']}}</textarea>
                                              </div>
                                          </div>
                                      </div>

                                      <div class="col-12">
                                          <div class="form-group">
                                              <div class="controls">
                                                  <label for="account-name">{{awtTrans('عنوان قسم شركائنا بالعربية')}}</label>
                                                  <textarea class="form-control" name="parteners_text_ar" id="" cols="30" rows="10" placeholder="{{awtTrans('عنوان قسم شركائنا بالعربية')}}">{{$data['parteners_text_ar']}}</textarea>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="col-12">
                                          <div class="form-group">
                                              <div class="controls">
                                                  <label for="account-name">{{awtTrans('عنوان قسم شركائنا  بالانجليزية')}}</label>
                                                  <textarea class="form-control" name="parteners_text_en" id="" cols="30" rows="10" placeholder="{{awtTrans('parteners_text_en')}}">{{$data['parteners_text_en']}}</textarea>
                                              </div>
                                          </div>
                                      </div>

                                      <div class="col-12">
                                          <div class="form-group">
                                              <div class="controls">
                                                  <label for="account-name">{{awtTrans('عنوان قسم تواصل بالعربية')}}</label>
                                                  <textarea class="form-control" name="contact_text_ar" id="" cols="30" rows="10" placeholder="{{awtTrans('عنوان قسم تواصل بالعربية')}}">{{$data['contact_text_ar']}}</textarea>
                                              </div>
                                          </div>
                                      </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-name">{{awtTrans('عنوان قسم تواصل  بالانجليزية')}}</label>
                                                    <textarea class="form-control" name="contact_text_en" id="" cols="30" rows="10" placeholder="{{awtTrans('عنوان قسم تواصل  بالانجليزية')}}">{{$data['contact_text_en']}}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 d-flex justify-content-center mt-3">
                                          <button type="submit" class="btn btn-primary mr-1 mb-1 submit_button">{{awtTrans('حفظ التغييرات')}}</button>
                                          <a href="{{ url()->previous() }}" type="reset" class="btn btn-outline-warning mr-1 mb-1">{{awtTrans(' رجوع ')}}</a>
                                      </div>
                                    </div>
                                </form>
                              </div>

                              <div role="tabpanel" class="tab-pane" id="account-vertical-about" aria-labelledby="account-pill-about" aria-expanded="false">
                                <form action="{{route('admin.settings.update')}}" method="post" enctype="multipart/form-data">
                                    @method('put')
                                    @csrf
                                    <div class="row">
                                      <div class="col-12">
                                        <div class="row">
                                          <div class="imgMontg col-6 text-center">
                                              <div class="dropBox">
                                                  <div class="textCenter d-flex flex-lg-column">
                                                      <div class="imagesUploadBlock">
                                                          <label class="uploadImg">
                                                              <span><i class="feather icon-image"></i></span>
                                                              <input type="file" accept="image/*" name="about_image_1" class="imageUploader">
                                                          </label>
                                                          <div class="uploadedBlock">
                                                              <img src="{{url('storage/images/settings/about_image_1.png')}}">
                                                              <button class="close"><i class="feather icon-trash-2"></i></button>
                                                          </div>
                                                        </div>
                                                        <span>{{awtTrans('صورة عن التطبيق الاولي')}}</span>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="imgMontg col-6 text-center">
                                              <div class="dropBox">
                                                  <div class="textCenter d-flex flex-lg-column">
                                                      <div class="imagesUploadBlock">
                                                          <label class="uploadImg">
                                                              <span><i class="feather icon-image"></i></span>
                                                              <input type="file" accept="image/*" name="about_image_2" class="imageUploader">
                                                          </label>
                                                          <div class="uploadedBlock">
                                                              <img src="{{url('storage/images/settings/about_image_2.png')}}">
                                                              <button class="close"><i class="feather icon-trash-2"></i></button>
                                                          </div>
                                                        </div>
                                                        <span>{{awtTrans('صورة عن التطبيق الثانية')}}</span>
                                                  </div>
                                              </div>
                                          </div>
                                        </div>
                                      </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-name">{{awtTrans('عن التطبيق بالعربية')}}</label>
                                                    <textarea class="form-control" name="intro_about_ar" id="" cols="30" rows="10" placeholder="{{awtTrans('عن التطبيق بالعربية')}}">{{$data['intro_about_ar']}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-name">{{awtTrans('عن التطبيق بالانجليزية')}}</label>
                                                    <textarea class="form-control" name="intro_about_en" id="" cols="30" rows="10" placeholder="{{awtTrans('عن التطبيق بالانجليزية')}}">{{$data['intro_about_en']}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-center mt-3">
                                          <button type="submit" class="btn btn-primary mr-1 mb-1 submit_button">{{awtTrans('حفظ التغييرات')}}</button>
                                          <a href="{{ url()->previous() }}" type="reset" class="btn btn-outline-warning mr-1 mb-1">{{awtTrans(' رجوع ')}}</a>
                                      </div>
                                    </div>
                                </form>
                              </div>

                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
  <!-- account setting page end -->

</div>

@endsection
@section('js')
  {{-- show selected image script --}}
    @include('admin.shared.addImage')
  {{-- show selected image script --}}
@endsection

    {{-- <section class="content settings">
        <div class="card page-body">
            <div class="card card-primary card-tabs m-2">
                <div class="card-header p-0 pt-1 border-bottom-0">
                  <ul class="nav nav-tabs text-md" id="custom-tabs-two-tab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill" href="#main-tab" role="tab" aria-controls="to-main" aria-selected="true">{{awtTrans('إعدادات التطبيق')}}</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="custom-tabs-two-texts-tab" data-toggle="pill" href="#texts-tab" role="tab" aria-controls="to-texts" aria-selected="true">{{awtTrans('نصوص متكررة')}}</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link"  data-toggle="pill" href="#about-tab" role="tab" aria-controls="to-about" aria-selected="false">{{awtTrans('من نحن')}}</a>
                    </li>
                  </ul>
                </div>
                <div class="card-body">
                  <div class="tab-content" id="custom-tabs-two-tabContent">

                    <!---------------- Main ------------------>
                    <div class="tab-pane fade show active" id="main-tab" role="tabpanel" aria-labelledby="to-main" >

                      <form action="{{route('admin.settings.update')}}" method="post" enctype="multipart/form-data">
                          @method('put')
                          @csrf

                          <div class="row">
                              <div class="col-sm-6">
                                  <div class="form-group">
                                      <label>{{awtTrans('اسم الموقع التعريفي بالعربي')}}</label>
                                  <input type="text" name="intro_name_ar" class="form-control" value="{{$data['intro_name_ar']}}" required>
                                  </div>
                              </div>
                              <div class="col-sm-6">
                                  <div class="form-group">
                                      <label>{{awtTrans('اسم الموقع التعريفي بالانجليزية')}}</label>
                                      <input type="text" name="intro_name_en" class="form-control" value="{{$data['intro_name_en']}}"  required>
                                  </div>
                              </div>
                              <div class="col-sm-6">
                                  <div class="form-group">
                                      <label>{{awtTrans('البريد الالكتروني')}}</label>
                                  <input type="email" name="intro_email" class="form-control" value="{{$data['email']}}"  required>
                                  </div>
                              </div>
                              <div class="col-sm-6">
                                  <div class="form-group">
                                      <label>{{awtTrans('رقم الهاتف')}}</label>
                                      <input type="text" name="intro_phone" class="form-control" value="{{$data['phone']}}" required>
                                  </div>
                              </div>
                              <div class="col-sm-6">
                                  <div class="form-group">
                                      <label>{{awtTrans('العنوان')}}</label>
                                      <input type="text" name="intro_address" class="form-control" value="{{$data['intro_address']}}" required>
                                  </div>
                              </div>
                              <div class="col-sm-12">
                                <div class="row">
                                  <div class="col-sm-4">
                                      <div class="form-group">
                                          <label>{{awtTrans('لون الموقع الرئيسي')}}</label>
                                          <input type="color" name="color" class="form-control" value="{{$data['color']}}" required>
                                      </div>
                                  </div>

                                  <div class="col-sm-4">
                                      <div class="form-group">
                                          <label>{{awtTrans('لون الButtons')}}</label>
                                          <input type="color" name="buttons_color" class="form-control" value="{{$data['buttons_color']}}" required>
                                      </div>
                                  </div>
                                  <div class="col-sm-4">
                                      <div class="form-group">
                                          <label>{{awtTrans('لون ال hover')}}</label>
                                          <input type="color" name="hover_color" class="form-control" value="{{$data['hover_color']}}" required>
                                      </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-sm-3">
                                <div class="">
                                      <label>{{awtTrans('صوره اللوجو')}}</label>
                                      <div class="dropBox">
                                          <div class="textCenter">
                                              <div class="imagesUploadBlock">
                                                  <label class="uploadImg">
                                                      <span><i class="la la-image"></i></span>
                                                      <input type="file" accept="image/*" name="intro_logo" class="imageUploader">
                                                  </label>
                                                  <div class="uploadedBlock">
                                                    <img src="{{asset('/storage/images/settings/intro_logo.png')}}">
                                                    <button class="close">
                                                      <i class="la la-times"></i>
                                                    </button>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-sm-3">
                                <div class="">
                                      <label>{{awtTrans('صوره ال loader')}}</label>
                                      <div class="dropBox">
                                          <div class="textCenter">
                                              <div class="imagesUploadBlock">
                                                  <label class="uploadImg">
                                                      <span><i class="la la-image"></i></span>
                                                      <input type="file" accept="image/*" name="intro_loader" class="imageUploader">
                                                  </label>
                                                  <div class="uploadedBlock">
                                                    <img src="{{asset('/storage/images/settings/intro_loader.png')}}">
                                                    <button class="close">
                                                      <i class="la la-times"></i>
                                                    </button>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>


                              <div class="col-sm-12 mt-2 text-center">
                                <div class="form-group"><button type="submit" class="btn btn-primary saveFormBtn">{{awtTrans('حفظ')}}</button></div>
                              </div>

                          </div>
                      </form>
                    </div>

                    <!---------------- About ------------------>
                      <div class="tab-pane fade" id="about-tab" role="tabpanel" aria-labelledby="to-about">
                        <form enctype="multipart/form-data" action="{{route('admin.settings.update')}}" method="post">
                          @method('put')
                          @csrf

                          <div class="row">
                              <div class="col-sm-12">
                                <div class="form-group">
                                  <label>{{awtTrans('من نحن بالعربية')}}</label>
                                  <textarea name="intro_about_ar" class="form-control" rows="10">{{$data['intro_about_ar']}}</textarea>
                                </div>
                              </div>

                              <div class="col-sm-12">
                                  <div class="form-group">
                                    <label>{{awtTrans('من نحن بالانجليزية')}}</label>
                                    <textarea name="intro_about_en" class="form-control" rows="10">{{$data['intro_about_en']}}</textarea>
                                  </div>
                              </div>

                              <div class="col-sm-3">
                                  <div class="">
                                        <label>{{awtTrans('الصوره الاولي')}}</label>
                                        <div class="dropBox">
                                            <div class="textCenter">
                                                <div class="imagesUploadBlock">
                                                    <label class="uploadImg">
                                                        <span><i class="la la-image"></i></span>
                                                        <input type="file" accept="image/*" name="about_image_1" class="imageUploader">
                                                    </label>
                                                    <div class="uploadedBlock">
                                                      <img src="{{asset('/storage/images/settings/about_image_1.png')}}">
                                                      <button class="close">
                                                        <i class="la la-times"></i>
                                                      </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                              </div>
                              <div class="col-sm-3">
                                  <div class="">
                                        <label>{{awtTrans('الصوره الثانية')}}</label>
                                        <div class="dropBox">
                                            <div class="textCenter">
                                                <div class="imagesUploadBlock">
                                                    <label class="uploadImg">
                                                        <span><i class="la la-image"></i></span>
                                                        <input type="file" accept="image/*" name="about_image_2" class="imageUploader">
                                                    </label>
                                                    <div class="uploadedBlock">
                                                      <img src="{{asset('/storage/images/settings/about_image_2.png')}}">
                                                      <button class="close">
                                                        <i class="la la-times"></i>
                                                      </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                              </div>

                              <div class="col-sm-12 mt-2 text-center">
                                <div class="form-group"><button type="submit" class="btn btn-primary saveFormBtn">{{awtTrans('حفظ')}}</button></div>
                              </div>
                          </div>
                        </form>
                      </div>
                    <!---------------- texts ------------------>
                    <div class="tab-pane fade" id="texts-tab" role="tabpanel" aria-labelledby="to-texts">
                      <form enctype="multipart/form-data" action="{{route('admin.settings.update')}}" method="post">
                        @method('put')
                        @csrf

                          <div class="row">
                              <div class="col-sm-12">
                                <div class="form-group">
                                  <label>{{awtTrans('عنوان قسم خدماتنا بالعربية')}}</label>
                                  <textarea name="services_text_ar" class="form-control" rows="10">{{$data['services_text_ar']}}</textarea>
                                </div>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-sm-12">
                                <div class="form-group">
                                  <label>{{awtTrans('عنوان قسم خدماتنا بالانجليزية')}}</label>
                                  <textarea name="services_text_en" class="form-control" rows="10">{{$data['services_text_en']}}</textarea>
                                </div>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-sm-12">
                                <div class="form-group">
                                  <label>{{awtTrans('عنوان قسم كيف يعمل الموقع بالعربية')}}</label>
                                  <textarea name="how_work_text_ar" class="form-control" rows="10">{{$data['how_work_text_ar']}}</textarea>
                                </div>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-sm-12">
                                <div class="form-group">
                                  <label>{{awtTrans('عنوان قسم كيف يعمل الموقع  بالانجليزية')}}</label>
                                  <textarea name="how_work_text_en" class="form-control" rows="10">{{$data['how_work_text_en']}}</textarea>
                                </div>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-sm-12">
                                <div class="form-group">
                                  <label>{{awtTrans('عنوان قسم الاسئلة الشائعه بالعربية')}}</label>
                                  <textarea name="fqs_text_ar" class="form-control" rows="10">{{$data['fqs_text_ar']}}</textarea>
                                </div>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-sm-12">
                                <div class="form-group">
                                  <label>{{awtTrans('عنوان قسم الاسئلة الشائعه  بالانجليزية')}}</label>
                                  <textarea name="fqs_text_en" class="form-control" rows="10">{{$data['fqs_text_en']}}</textarea>
                                </div>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-sm-12">
                                <div class="form-group">
                                  <label>{{awtTrans('عنوان قسم شركائنا بالعربية')}}</label>
                                  <textarea name="parteners_text_ar" class="form-control" rows="10">{{$data['parteners_text_ar']}}</textarea>
                                </div>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-sm-12">
                                <div class="form-group">
                                  <label>{{awtTrans('عنوان قسم شركائنا  بالانجليزية')}}</label>
                                  <textarea name="parteners_text_en" class="form-control" rows="10">{{$data['parteners_text_en']}}</textarea>
                                </div>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-sm-12">
                                <div class="form-group">
                                  <label>{{awtTrans('عنوان قسم تواصل بالعربية')}}</label>
                                  <textarea name="contact_text_ar" class="form-control" rows="10">{{$data['contact_text_ar']}}</textarea>
                                </div>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-sm-12">
                                <div class="form-group">
                                  <label>{{awtTrans('عنوان قسم تواصل  بالانجليزية')}}</label>
                                  <textarea name="contact_text_en" class="form-control" rows="10">{{$data['contact_text_en']}}</textarea>
                                </div>
                              </div>
                          </div>



                            <div class="col-sm-12 mt-2 text-center">
                              <div class="form-group"><button type="submit" class="btn btn-primary saveFormBtn">{{awtTrans('حفظ')}}</button></div>
                            </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
        </div>
    </section> --}}
