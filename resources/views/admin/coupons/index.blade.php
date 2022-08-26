@extends('admin.layout.master')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/vendors/css/tables/datatable/datatables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/vendors/css/tables/datatable/extensions/dataTables.checkboxes.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css-rtl/pages/data-list-view.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css-rtl/core/colors/palette-gradient.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/vendors/css/extensions/sweetalert2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/vendors/css/pickers/pickadate/pickadate.css')}}">
@endsection

@section('content')
        <x-admin.table filter="true"  addbutton="{{route('admin.coupons.create')}}" deletebutton="{{route('admin.coupons.deleteAll')}}">
            <x-slot name="tableHead">
                <th>
                    <label class="container-checkbox">
                        <input type="checkbox" value="value1" name="name1" id="checkedAll">
                        <span class="checkmark"></span>
                    </label>
                </th>
                <th>{{awtTrans('التاريخ')}}</th>
                <th>{{awtTrans('رقم الكوبون')}}</th>
                <th>{{awtTrans('نوع الخصم')}}</th>
                <th>{{awtTrans('قيمة الخصم')}}</th>
                <th>{{awtTrans('تاريخ الانتهاء')}}</th>
                <th>*</th>
                <th>{{awtTrans('التحكم')}}</th>
            </x-slot>
            <x-slot name="tableBody">
                @foreach($rows as $row)
                    <tr class="delete_row">
                        <td class="text-center">
                            <label class="container-checkbox">
                                <input type="checkbox" class="checkSingle" id="{{$row->id}}">
                                <span class="checkmark"></span>
                            </label>
                        </td>
                        <td>{{\Carbon\Carbon::parse($row->created_at)->format('d/m/Y')}}</td>
                        <td>{{$row->identity}}</td>
                        <td>{{$row->type == 'ratio' ? 'نسبة' :  'رقم ثابت'}}</td>
                        <td>{{$row->discount}}</td>
                        <td>{{date('d-m-Y', strtotime($row->expire_date))}}</td>
                        <td>
                            @if($row->status == 'available')
                                <span class="btn btn-sm round btn-outline-danger change-coupon-status" data-status="closed" data-id="{{$row->id}}"> 
                                    {{awtTrans('ايقاف الكوبون')}}  <i class="feather icon-slash"></i>
                                </span>
                            @else
                                <span class="btn btn-sm round btn-outline-success open-coupon" data-toggle="modal" id="div_{{$row->id}}" data-target="#notify" data-id="{{$row->id}}"> 
                                    {{awtTrans('اعاده تنشيط الكوبون')}}  <i class="feather icon-rotate-cw"></i>
                                </span>
                            @endif
                        </td>
                        <td class="product-action">
                            <span class="action-edit text-primary"><a href="{{route('admin.coupons.edit' , ['id' => $row->id])}}"><i class="feather icon-edit"></i></a></span>
                            <span class="delete-row text-danger" data-url="{{url('admin/coupons/'.$row->id)}}"><i class="feather icon-trash"></i></span>
                        </td>
                    </tr>
                @endforeach
            </x-slot>
        </x-admin.table >
    {{-- #table --}}

    <div class="modal fade text-left" id="notify" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary white">
                    <h5 class="modal-title" id="myModalLabel160">{{awtTrans('تحدبث حالة الكوبون')}}</h5>
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body"> 
                    <form action="{{route('admin.coupons.renew')}}" method="POST" enctype="multipart/form-data" class="notify-form">
                        @csrf
                        <input type="hidden" name="id" class="coupon_id">
                        <input type="hidden" name="status" value="available">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="first-name-column">{{awtTrans('عدد مرات الاستخدام')}}</label>
                                    <div class="controls">
                                        <input type="number" name="usage"  class="form-control" placeholder="{{awtTrans('اكتب عدد مرات الاستخدام')}}" required data-validation-required-message="{{awtTrans('هذا الحقل مطلوب')}}" >
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="first-name-column">{{awtTrans('نوع الخصم')}}</label>
                                    <div class="controls">
                                        <select name="type" class="select2 form-control" required data-validation-required-message="{{awtTrans('هذا الحقل مطلوب')}}" >
                                            <option value>{{awtTrans('اختر حالة الخصم')}}</option>
                                            <option value="ratio">{{awtTrans('نسبة')}}</option>
                                            <option  value="number">{{awtTrans('رقم ثابت')}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="first-name-column">{{awtTrans('قيمة الخصم')}}</label>
                                    <div class="controls">
                                        <input type="number" name="discount" class="discount form-control" placeholder="{{awtTrans('اكتب قيمة الخصم')}}" required data-validation-required-message="{{awtTrans('هذا الحقل مطلوب')}}" >
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="first-name-column">{{awtTrans('اكبر قيمة للخصم')}}</label>
                                    <div class="controls">
                                        <input readonly type="number"  name="max_discount" class="max_discount form-control" placeholder="{{awtTrans('اكتب اكبر قيمة للخصم')}}" required data-validation-required-message="{{awtTrans('هذا الحقل مطلوب')}}" >
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="first-name-column">{{awtTrans('تاريخ الانتهاء')}}</label>
                                    <div class="controls">
                                        <input  type="text"  name="expire_date" class="pickadate form-control"  required data-validation-required-message="{{awtTrans('هذا الحقل مطلوب')}}" >
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary send-notify-button" >{{awtTrans('تحديث')}}</button>
                            <button type="button" class="btn btn-primary" data-dismiss="modal">{{awtTrans('الفاء')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{asset('admin/app-assets/vendors/js/tables/datatable/datatables.min.js')}}"></script>
    <script src="{{asset('admin/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js')}}"></script>
    <script src="{{asset('admin/app-assets/vendors/js/tables/datatable/pdfmake.min.js')}}"></script>
    <script src="{{asset('admin/app-assets/vendors/js/tables/datatable/buttons.html5.min.js')}}"></script>
    <script src="{{asset('admin/app-assets/vendors/js/tables/datatable/buttons.print.min.js')}}"></script>
    <script src="{{asset('admin/app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js')}}"></script>
    <script src="{{asset('admin/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('admin/datatable_custom.js')}}"></script>
    <script src="{{asset('admin/search.js')}}"></script>
    <script src="{{asset('admin/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('admin/app-assets/js/scripts/extensions/sweet-alerts.js')}}"></script>
    <script src="{{asset('admin/app-assets/vendors/js/pickers/pickadate/picker.js')}}"></script>
    <script src="{{asset('admin/app-assets/vendors/js/pickers/pickadate/picker.date.js')}}"></script>
    <script src="{{asset('admin/app-assets/js/scripts/pickers/dateTime/pick-a-datetime.js')}}"></script>

    <script>
        $(document).on('click' , '.open-coupon', function () {
            $('.coupon_id').val($(this).data('id'))
        })
        
        $(document).on('click' , '.change-coupon-status', function () {
            $.ajax({
                type: "POST",
                url: "{{route('admin.coupons.renew')}}",
                data: {id : $(this).data('id') , status : $(this).data('status')},
                dataType: "json",
                success:  (response)=> {
                    $(this).parent().html(response.html)
                    Swal.fire({
                                    position: 'top-start',
                                    type: 'success',
                                    title: response.message,
                                    showConfirmButton: false,
                                    timer: 1500,
                                    confirmButtonClass: 'btn btn-primary',
                                    buttonsStyling: false,
                                })
                }
            });
        });
    </script>
    <script>
        $(document).on('change','.select2', function () {
            if ($(this).val() == 'ratio') {
                $('.max_discount').prop('readonly', false);
            }else{
                $('.max_discount').prop('readonly', true);
            }
        });
    </script>
    <script>
        $(document).on('keyup','.discount', function () {
            if ($('.select2').val() == 'number') {
                $('.max_discount').val($(this).val());
            }else{
                $('.max_discount').val(null);
            }
        });
    </script>

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
                    success: (response) => {
                        $(".text-danger").remove()
                        $('.store input').removeClass('border-danger')
                        $(".send-notify-button").html("{{awtTrans('تحديث')}}").attr('disable',false)
                        $('#notify').modal('toggle');
                        Swal.fire({
                                    position: 'top-start',
                                    type: 'success',
                                    title: response.message,
                                    showConfirmButton: false,
                                    timer: 1500,
                                    confirmButtonClass: 'btn btn-primary',
                                    buttonsStyling: false,
                                })
                        $('#div_'+response.id).parent().html(response.html)
                    },
                    error: function (xhr) {
                        $(".send-notify-button").html("{{awtTrans('تحديث')}}").attr('disable',false)
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

    {{-- delete all script --}}
        @include('admin.shared.deleteAll')
    {{-- delete all script --}}

    {{-- delete one user script --}}
        @include('admin.shared.deleteOne')
    {{-- delete one user script --}}
@endsection
