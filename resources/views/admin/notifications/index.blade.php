@extends('admin.layout.master')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/vendors/css/extensions/sweetalert2.min.css')}}">
@endsection

@section('content')
<section class="users-edit">
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <ul class="nav nav-tabs mb-3" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center active" id="notify-tab" data-toggle="tab" href="#notify" aria-controls="notify" role="tab" aria-selected="true">
                            <i class="feather icon-bell mr-25"></i><span class="d-none d-sm-block">{{awtTrans('ارسال اشعار')}}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" id="sms-tab" data-toggle="tab" href="#sms" aria-controls="sms" role="tab" aria-selected="false">
                            <i class="feather icon-phone mr-25"></i><span class="d-none d-sm-block">{{awtTrans('ارسال SMS')}}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" id="email-tab" data-toggle="tab" href="#email" aria-controls="email" role="tab" aria-selected="false">
                            <i class="feather icon-mail mr-25"></i><span class="d-none d-sm-block">{{awtTrans('ارسال بريد الكتروني ')}}</span>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="notify" aria-labelledby="notify-tab" role="tabpanel">
                        <form action="{{route('admin.notifications.send')}}" method="POST" enctype="multipart/form-data" class="notify-form">
                            @csrf
                            <input type="hidden" name="type" value="notify">
                            <div class="row">
                                <div class="col-md-6 col-6">
                                    <div class="form-group">
                                        <label for="first-name-column">{{awtTrans('عنوان الاشعار بالعربية')}}</label>
                                        <div class="controls">
                                            <input type="text" name="title_ar" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-6">
                                    <div class="form-group">
                                        <label for="first-name-column">{{awtTrans('عنوان الاشعار بالانجليزية')}}</label>
                                        <div class="controls">
                                            <input type="text" name="title_en" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="first-name-column">{{awtTrans('الرسالة بالعربية')}}</label>
                                        <div class="controls">
                                            <textarea name="message_ar" class="form-control" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="first-name-column">{{awtTrans('الرسالة بالانجليزية')}}</label>
                                        <div class="controls">
                                            <textarea name="message_en" class="form-control" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label for="first-name-column">{{awtTrans('ارسال الي ')}}</label>
                                        <div class="controls">
                                            <select name="user_type" class="select2 form-control" >
                                                <option value>{{awtTrans('اختر الفئه المرسل اليها')}}</option>
                                                <option  value="admins">{{awtTrans('المشرفين')}}</option>
                                                <option  value="all_users">{{awtTrans('كل المستخدمين')}}</option>
                                                <option  value="all_providers">{{awtTrans('كل مقدمين الخدمة')}}</option>
                                                <option  value="active_users">{{awtTrans('المتسخدمين النشطين')}}</option>
                                                <option  value="not_active_users">{{awtTrans('المتسخدمين الغير نشطين')}}</option>
                                                <option  value="blocked_users">{{awtTrans('المتسخدمين المحظورين')}}</option>
                                                <option  value="not_blocked_users">{{awtTrans('المتسخدمين الغير محظورين')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary send-notify-button" >{{awtTrans('ارسال')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane " id="sms" aria-labelledby="sms-tab" role="tabpanel">
                        <form action="{{route('admin.notifications.send')}}" method="POST" enctype="multipart/form-data" class="notify-form">
                            @csrf
                            <input type="hidden" name="type" value="sms">
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label for="first-name-column">{{awtTrans('نص الرسالة')}}</label>
                                        <div class="controls">
                                            <textarea name="message" class="form-control" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label for="first-name-column">{{awtTrans('ارسال الي ')}}</label>
                                        <div class="controls">
                                            <select name="user_type" class="select2 form-control" >
                                                <option value>{{awtTrans('اختر الفئه المرسل اليها')}}</option>
                                                <option  value="admins">{{awtTrans('المشرفين')}}</option>
                                                <option  value="all_users">{{awtTrans('كل المستخدمين')}}</option>
                                                <option  value="active_users">{{awtTrans('المتسخدمين النشطين')}}</option>
                                                <option  value="not_active_users">{{awtTrans('المتسخدمين الغير نشطين')}}</option>
                                                <option  value="blocked_users">{{awtTrans('المتسخدمين المحظورين')}}</option>
                                                <option  value="not_blocked_users">{{awtTrans('المتسخدمين الغير محظورين')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary send-notify-button" >{{awtTrans('ارسال')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane " id="email" aria-labelledby="email-tab" role="tabpanel">
                        <form action="{{route('admin.notifications.send')}}" method="POST" enctype="multipart/form-data" class="notify-form">
                            @csrf
                            <input type="hidden" name="type" value="email">
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label for="first-name-column">{{awtTrans('محتوي الايميل')}}</label>
                                        <div class="controls">
                                            <textarea name="message" class="form-control" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label for="first-name-column">{{awtTrans('ارسال الي ')}}</label>
                                        <div class="controls">
                                            <select name="user_type" class="select2 form-control" >
                                                <option value>{{awtTrans('اختر الفئه المرسل اليها')}}</option>
                                                <option  value="admins">{{awtTrans('المشرفين')}}</option>
                                                <option  value="all_users">{{awtTrans('كل المستخدمين')}}</option>
                                                <option  value="active_users">{{awtTrans('المتسخدمين النشطين')}}</option>
                                                <option  value="not_active_users">{{awtTrans('المتسخدمين الغير نشطين')}}</option>
                                                <option  value="blocked_users">{{awtTrans('المتسخدمين المحظورين')}}</option>
                                                <option  value="not_blocked_users">{{awtTrans('المتسخدمين الغير محظورين')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary send-notify-button" >{{awtTrans('ارسال')}}</button>
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

<script src="{{asset('admin/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('admin/app-assets/js/scripts/extensions/sweet-alerts.js')}}"></script>
<script>
    $(document).ready(function(){
        $(document).on('submit','.notify-form',function(e){
            e.preventDefault();
            var url = $(this).attr('action')
            $.ajax({
                url: url,
                method: 'post',
                data: new FormData($(this)[0]),
                dataType:'json',
                processData: false,
                contentType: false,
                beforeSend: function(){
                    $(".send-notify-button").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>').attr('disable',true)
                },
                success: (response)=>{
                    $(".text-danger").remove()
                    $('.store input').removeClass('border-danger')
                    $(".send-notify-button").html("{{awtTrans('ارسال')}}").attr('disable',false)
                    Swal.fire({
                                position: 'top-start',
                                type: 'success',
                                title: '{{awtTrans('تمت الارسال بنجاح')}}',
                                showConfirmButton: false,
                                timer: 1500,
                                confirmButtonClass: 'btn btn-primary',
                                buttonsStyling: false,
                            })
                    $(this).trigger("reset")
                },
                error: function (xhr) {
                    $(".send-notify-button").html("{{awtTrans('ارسال')}}").attr('disable',false)
                    $(".text-danger").remove()
                    $('.store input').removeClass('border-danger')

                    $.each(xhr.responseJSON.errors, function(key,value) {
                        $('.store input[name='+key+']').addClass('border-danger')
                        $('.store input[name='+key+']').after(`<span class="mt-5 text-danger">${value}</span>`);
                        $('.store select[name='+key+']').after(`<span class="mt-5 text-danger">${value}</span>`);
                    });
                },
            });

        });
    });
</script>
@endsection
