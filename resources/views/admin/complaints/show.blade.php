@extends('admin.layout.master')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/vendors/css/extensions/sweetalert2.min.css')}}">

@endsection
@section('content')
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{awtTrans('عرض الرساله')}}</h4>
                    </div>

                    <div class="card-content">
                        <div class="card-body">
                            <form>
                                @csrf
                                @method('PUT')
                                <div class="form-body">
                                    <div class="row">

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{awtTrans('رقم الهاتف')}}</label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" disabled
                                                       value="{{isset($row->user) ? $row->user->name : $row->phone}}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{awtTrans('البريد الالكتروني')}}</label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" disabled
                                                           value="{{isset($row->user) ? $row->user->email : $row->email}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{awtTrans('العنوان')}}</label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" disabled
                                                        value="{{isset($row->title) ? $row->title : 'الموقع'}}" >
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{awtTrans('الشكوي')}}</label>
                                                <div class="controls">
                                                    <textarea class="form-control" cols="30" rows="10" disabled>{{$row->complaint}}</textarea>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-12 d-flex justify-content-center mt-3">
                                            <a href="{{ url()->previous() }}" type="reset" class="btn btn-outline-warning mr-1 mb-1">{{awtTrans(' رجوع ')}}</a>
                                            <a data-toggle="modal" data-target="#replay"  class="btn btn-outline-primary mr-1 mb-1">{{awtTrans(' رد ')}}</a>
                                        </div>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade text-left" id="replay" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary white">
                        <h5 class="modal-title" id="myModalLabel160">{{awtTrans('الرد')}}</h5>
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('admin.complaint.replay' , ['id' => $row->id])}}" method="POST" enctype="multipart/form-data" class="notify-form">
                            @csrf
                            <div class="col-md-12 col-12">
                                <div class="form-group">
                                    <label for="first-name-column">{{awtTrans('الرد ارسال SMS')}}</label>
                                    <div class="controls">
                                        <textarea name="replay" required data-validation-required-message="{{awtTrans('هذا الحقل مطلوب')}}"
                                                  class="form-control" cols="30" rows="4" ></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary send-notify-button" >{{awtTrans('ارسال')}}</button>
                                <button type="button" class="btn btn-primary" data-dismiss="modal">{{awtTrans('الفاء')}}</button>
                            </div>
                        </form>
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
                    success: function(response){
                        $(".text-danger").remove()
                        $('.store input').removeClass('border-danger')
                        $(".send-notify-button").html("{{awtTrans('ارسال')}}").attr('disable',false)
                        Swal.fire({
                                    position: 'top-start',
                                    type: 'success',
                                    title: '{{awtTrans('تم الرد بنجاح')}}',
                                    showConfirmButton: false,
                                    timer: 1500,
                                    confirmButtonClass: 'btn btn-primary',
                                    buttonsStyling: false,
                                })
                        setTimeout(function(){
                            window.location.replace(response.url)
                        }, 1000);
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
