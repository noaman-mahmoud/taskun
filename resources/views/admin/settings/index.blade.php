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
                          <i class="feather icon-settings mr-50 font-medium-3"></i>
                          {{awtTrans('الاعدادات')}}
                      </a>
                  </li>
                  <li class="nav-item" style="margin-top: 3px" >
                      <a class="nav-link d-flex py-75" id="account-pill-terms" data-toggle="pill" href="#account-vertical-terms" aria-expanded="false">
                          <i class="feather icon-edit-1 mr-50 font-medium-3"></i>
                          {{awtTrans('الشروط والاحكام')}}
                      </a>
                  </li>
                  <li class="nav-item " style="margin-top: 3px">
                      <a class="nav-link d-flex py-75" id="account-pill-about" data-toggle="pill" href="#account-vertical-about" aria-expanded="false">
                          <i class="feather icon-edit-1 mr-50 font-medium-3"></i>
                          {{awtTrans('عن التطبيق')}}
                      </a>
                  </li>
                  <li class="nav-item " style="margin-top: 3px">
                      <a class="nav-link d-flex py-75" id="account-pill-privacy" data-toggle="pill" href="#account-vertical-privacy" aria-expanded="false">
                          <i class="feather icon-award mr-50 font-medium-3"></i>
                          {{awtTrans('سياسة الخصوصية')}}
                      </a>
                  </li>
                  <li class="nav-item " style="margin-top: 3px">
                      <a class="nav-link d-flex py-75" id="account-pill-management" data-toggle="pill" href="#account-vertical-management" aria-expanded="false">
                          <i class="feather icon-award mr-50 font-medium-3"></i>
                          {{awtTrans('رسوم التطبيق لادارة الاملاك')}}
                      </a>
                  </li>
                  <li class="nav-item " style="margin-top: 3px">
                      <a class="nav-link d-flex py-75" id="account-pill-smtp" data-toggle="pill" href="#account-vertical-smtp" aria-expanded="false">
                          <i class="feather icon-mail mr-50 font-medium-3"></i>
                          {{awtTrans('بيانات الايميل')}}
                      </a>
                  </li>
                  <li class="nav-item " style="margin-top: 3px">
                      <a class="nav-link d-flex py-75" id="account-pill-notifications" data-toggle="pill" href="#account-vertical-notifications" aria-expanded="false">
                          <i class="feather icon-bell mr-50 font-medium-3"></i>
                          {{awtTrans('بيانات الاشعارات')}}
                      </a>
                  </li>
                  <li class="nav-item " style="margin-top: 3px">
                      <a class="nav-link d-flex py-75" id="account-pill-api" data-toggle="pill" href="#account-vertical-api" aria-expanded="false">
                          <i class="feather icon-droplet mr-50 font-medium-3"></i>
                          {{awtTrans('بيانات api')}}
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
                                <form accept="{{route('admin.settings.update')}}" method="post" enctype="multipart/form-data">
                                  @method('put')
                                  @csrf
                                <div class="row">
                                  <div class="col-6">
                                        <div class="form-group">
                                            <div class="controls">
                                                <label for="account-name">{{awtTrans('اسم التطبيق بالعربي')}}</label>
                                                <input type="text" class="form-control" name="name_ar" id="account-name" placeholder="{{awtTrans('اسم التطبيق بالعربي')}}" value="{{$data['name_ar']}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <div class="controls">
                                                <label for="account-name">{{awtTrans('اسم التطبيق بالعربي')}}</label>
                                                <input type="text" class="form-control" name="name_en" id="account-name" placeholder="{{awtTrans('اسم التطبيق بالعربي')}}" value="{{$data['name_en']}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <div class="controls">
                                                <label for="account-name">{{awtTrans('البريد الالكتروني')}}</label>
                                                <input type="text" class="form-control" name="email" id="account-name" placeholder="{{awtTrans('البريد الالكتروني')}}" value="{{$data['email']}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <div class="controls">
                                                <label for="account-name">{{awtTrans('رقم الهاتف')}}</label>
                                                <input type="text" class="form-control" name="phone" id="account-name" placeholder="{{awtTrans('رقم الهاتف')}}" value="{{$data['phone']}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <div class="controls">
                                                <label for="account-name">{{awtTrans('رقم الواتس اب')}}</label>
                                                <input type="text" class="form-control" name="whatsapp" id="account-name" placeholder="{{awtTrans('رقم الواتس اب')}}" value="{{$data['whatsapp']}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <div class="controls">
                                                <label for="account-name">{{awtTrans('اتاحة ارسال الرسالة')}}</label>
                                                <select name="send_message" class="form-control">
                                                    <option value="1" {{$data['send_message'] == 1 ? 'selected' : ''}} >اتاحة الارسال</option>
                                                    <option value="0" {{$data['send_message'] == 0 ? 'selected' : ''}}>عدم اتاحة الارساله</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="controls">
                                                <label for="account-name">{{awtTrans('نص الرساله يجب وضع علامة مع الترتيب')}}</label>
                                                <label for="account-name" style="color:red;font-weight:bold">{{awtTrans('0#')}}</label>
                                                <label for="account-name">{{awtTrans('مكان فرغ كتابة المالك ')}}</label>
                                                <hr>
                                                 <label for="account-name">{{awtTrans('مثال :- نفيدكم أن عقد الايجار رقم 0# يحل القسط رقم 1#')}}</label>
                                                <textarea rows="3" class="form-control" name="message_text">{{$data['message_text']}}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="controls">
                                                <label for="account-name">{{awtTrans('حاسبة العمولة')}}</label>
                                                <input type="number" class="form-control" name="commission" id="account-name" placeholder="{{awtTrans('حاسبة العمولة')}}" value="{{$data['commission']}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="controls">
                                                <label for="account-name">{{awtTrans('حاسبة السعي')}}</label>
                                                <input type="number" class="form-control" name="pursuit" id="account-name" placeholder="{{awtTrans('حاسبة السعي')}}" value="{{$data['pursuit']}}">
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
                                                            <input type="file" accept="image/*" name="logo" class="imageUploader">
                                                        </label>
                                                        <div class="uploadedBlock">
                                                            <img src="{{asset('/storage/images/settings/logo.png')}}">
                                                            <button class="close"><i class="feather icon-trash-2"></i></button>
                                                        </div>
                                                      </div>
                                                      <span>{{awtTrans('صورة لوجو الموقع')}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="imgMontg col-2 text-center">
                                            <div class="dropBox">
                                                <div class="textCenter d-flex flex-lg-column">
                                                    <div class="imagesUploadBlock">
                                                        <label class="uploadImg">
                                                            <span><i class="feather icon-image"></i></span>
                                                            <input type="file" accept="image/*" name="fav_icon" class="imageUploader">
                                                        </label>
                                                        <div class="uploadedBlock">
                                                            <img src="{{asset('/storage/images/settings/fav_icon.png')}}">
                                                            <button class="close"><i class="feather icon-trash-2"></i></button>
                                                        </div>
                                                      </div>
                                                      <span>{{awtTrans('صورة ال fav icon')}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="imgMontg col-2 text-center">
                                            <div class="dropBox">
                                                <div class="textCenter d-flex flex-lg-column">
                                                    <div class="imagesUploadBlock">
                                                        <label class="uploadImg">
                                                            <span><i class="feather icon-image"></i></span>
                                                            <input type="file" accept="image/*" name="login_background" class="imageUploader">
                                                        </label>
                                                        <div class="uploadedBlock">
                                                            <img src="{{asset('/storage/images/settings/login_background.png')}}">
                                                            <button class="close"><i class="feather icon-trash-2"></i></button>
                                                        </div>
                                                      </div>
                                                      <span>{{awtTrans('صورة خلفية صفحة تسجيل الدخول')}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="imgMontg col-2 text-center">
                                            <div class="dropBox">
                                                <div class="textCenter d-flex flex-lg-column">
                                                    <div class="imagesUploadBlock">
                                                        <label class="uploadImg">
                                                            <span><i class="feather icon-image"></i></span>
                                                            <input type="file" accept="image/*" name="default_user" class="imageUploader">
                                                        </label>
                                                        <div class="uploadedBlock">
                                                            <img src="{{asset('/storage/images/users/default.png')}}">
                                                            <button class="close"><i class="feather icon-trash-2"></i></button>
                                                        </div>
                                                      </div>
                                                      <span>{{awtTrans('صورة المستخدم الافتراضية')}}</span>
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

                              <div role="tabpanel" class="tab-pane" id="account-vertical-terms" aria-labelledby="account-pill-terms" aria-expanded="false">
                                <form accept="{{route('admin.settings.update')}}" method="post" enctype="multipart/form-data">
                                    @method('put')
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-name">{{awtTrans('الشروط والاحكام بالعربية')}}</label>
                                                    <textarea class="form-control" name="terms_ar" id="terms_ar_editor" cols="30" rows="10" placeholder="{{awtTrans('الشروط والاحكام')}}">{{$data['terms_ar']}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-name">{{awtTrans('الشروط والاحكام  بالانجليزية')}}</label>
                                                    <textarea class="form-control" name="terms_en" id="terms_en_editor" cols="30" rows="10" placeholder="{{awtTrans('الشروط والاحكام')}}">{{$data['terms_en']}}</textarea>
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
                                <form accept="{{route('admin.settings.update')}}" method="post" enctype="multipart/form-data">
                                    @method('put')
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-name">{{awtTrans('عن التطبيق بالعربية')}}</label>
                                                    <textarea class="form-control" name="about_ar" id="about_ar_editor" cols="30" rows="10" placeholder="{{awtTrans('عن التطبيق بالعربية')}}">{{$data['about_ar']}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-name">{{awtTrans('عن التطبيق بالانجليزية')}}</label>
                                                    <textarea class="form-control" name="about_en" id="about_en_editor" cols="30" rows="10" placeholder="{{awtTrans('عن التطبيق بالانجليزية')}}">{{$data['about_en']}}</textarea>
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

                              <div role="tabpanel" class="tab-pane" id="account-vertical-privacy" aria-labelledby="account-pill-privacy" aria-expanded="false">
                                <form accept="{{route('admin.settings.update')}}" method="post" enctype="multipart/form-data">
                                    @method('put')
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-name">{{awtTrans('سياسة خصوصية  التطبيق بالعربية')}}</label>
                                                    <textarea class="form-control" name="privacy_ar" id="privacy_ar_editor" cols="30" rows="10" placeholder="{{awtTrans('سياسة خصوصية  التطبيق بالعربية')}}">{{$data['privacy_ar']}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-name">{{awtTrans('سياسة خصوصية  التطبيق بالانجليزية')}}</label>
                                                    <textarea class="form-control" name="privacy_en" id="privacy_en_editor" cols="30" rows="10" placeholder="{{awtTrans('سياسة خصوصية  التطبيق بالانجليزية')}}">{{$data['privacy_en']}}</textarea>
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

                              <div role="tabpanel" class="tab-pane" id="account-vertical-management" aria-labelledby="account-pill-management" aria-expanded="false">
                                <form accept="{{route('admin.settings.update')}}" method="post" enctype="multipart/form-data">
                                    @method('put')
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-name">{{awtTrans('رسوم التطبيق بالعربية')}}</label>
                                                    <textarea class="form-control" name="management_fees_ar" id="management_fees_ar_editor" cols="30" rows="10" placeholder="{{awtTrans('رسوم التطبيق بالعربية')}}">{{$data['management_fees_ar']}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-name">{{awtTrans('رسوم  التطبيق بالانجليزية')}}</label>
                                                    <textarea class="form-control" name="management_fees_en" id="management_fees_editor" cols="30" rows="10" placeholder="{{awtTrans('رسوم التطبيق بالانجليزية')}}">{{$data['management_fees_en']}}</textarea>
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

                              <div role="tabpanel" class="tab-pane" id="account-vertical-smtp" aria-labelledby="account-pill-smtp" aria-expanded="false">
                                <form accept="{{route('admin.settings.update')}}" method="post" enctype="multipart/form-data">
                                    @method('put')
                                    @csrf
                                    <div class="row">

                                        <div class="col-6">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-name">{{awtTrans('اسم المستخدم')}}</label>
                                                    <input type="text" class="form-control" name="smtp_user_name" id="account-name" placeholder="{{awtTrans('اسم  المستخدم ')}}" value="{{$data['smtp_user_name']}}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-name">{{awtTrans('كلمة السر')}}</label>
                                                    <input type="password" class="form-control" name="smtp_password" id="account-name" placeholder="{{awtTrans('كلمة السر')}}" value="{{$data['smtp_password']}}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-name">{{awtTrans('الايميل المرسل')}}</label>
                                                    <input type="text" class="form-control" name="smtp_mail_from" id="account-name" placeholder="{{awtTrans('الايميل المرسل')}}" value="{{$data['smtp_mail_from']}}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-name">{{awtTrans('اسم المرسل')}}</label>
                                                    <input type="text" class="form-control" name="smtp_sender_name" id="account-name" placeholder="{{awtTrans('اسم  المرسل ')}}" value="{{$data['smtp_sender_name']}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-name">{{awtTrans('اسم الهوست')}}</label>
                                                    <input type="text" class="form-control" name="smtp_host" id="account-name" placeholder="{{awtTrans('اسم  الهوست ')}}" value="{{$data['smtp_host']}}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-name">{{awtTrans('نوع التشفير')}}</label>
                                                    <input type="text" class="form-control" name="smtp_encryption" id="account-name" placeholder="{{awtTrans('نوع التشفير')}}" value="{{$data['smtp_encryption']}}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-name">{{awtTrans('رقم البورت')}}</label>
                                                    <input type="number" class="form-control" name="smtp_port" id="account-name" placeholder="{{awtTrans('رقم البورت')}}" value="{{$data['smtp_port']}}">
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

                              <div role="tabpanel" class="tab-pane" id="account-vertical-notifications" aria-labelledby="account-pill-notifications" aria-expanded="false">
                                <form accept="{{route('admin.settings.update')}}" method="post" enctype="multipart/form-data">
                                    @method('put')
                                    @csrf
                                    <div class="row">

                                        <div class="col-6">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-name">{{awtTrans('server key')}}</label>
                                                    <input type="text" class="form-control" name="firebase_key" id="account-name" placeholder="{{awtTrans('server key')}}" value="{{$data['firebase_key']}}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-name">{{awtTrans('sender id')}}</label>
                                                    <input type="text" class="form-control" name="firebase_sender_id" id="account-name" placeholder="{{awtTrans('sender id')}}" value="{{$data['firebase_sender_id']}}">
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

                              <div role="tabpanel" class="tab-pane" id="account-vertical-api" aria-labelledby="account-pill-api" aria-expanded="false">
                                <form accept="{{route('admin.settings.update')}}" method="post" enctype="multipart/form-data">
                                    @method('put')
                                    @csrf
                                    <div class="row">

                                        <div class="col-6">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-name">{{awtTrans('live chat')}}</label>
                                                    <input type="text" class="form-control" name="live_chat" id="account-name" placeholder="{{awtTrans('live chat')}}" value="{{$data['live_chat']}}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-name">{{awtTrans('google analytics')}}</label>
                                                    <input type="text" class="form-control" name="google_analytics" id="account-name" placeholder="{{awtTrans('google analytics')}}" value="{{$data['google_analytics']}}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-name">{{awtTrans('google places')}}</label>
                                                    <input type="text" class="form-control" name="google_places" id="account-name" placeholder="{{awtTrans('google places')}}" value="{{$data['google_places']}}">
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
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script>
            CKEDITOR.replace( 'terms_ar_editor' );
    </script>
    <script>
            CKEDITOR.replace( 'terms_en_editor' );
    </script>
    <script>
            CKEDITOR.replace( 'privacy_ar_editor' );
    </script>
    <script>
            CKEDITOR.replace( 'privacy_en_editor' );
    </script>
    <script>
            CKEDITOR.replace( 'about_ar_editor' );
    </script>
    <script>
            CKEDITOR.replace( 'about_en_editor' );
    </script>

  {{-- show selected image script --}}
    @include('admin.shared.addImage')
  {{-- show selected image script --}}
@endsection

