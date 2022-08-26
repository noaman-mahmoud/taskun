@extends('admin.layout.master')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/vendors/css/tables/datatable/datatables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/vendors/css/tables/datatable/extensions/dataTables.checkboxes.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css-rtl/pages/data-list-view.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css-rtl/core/colors/palette-gradient.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/vendors/css/extensions/sweetalert2.min.css')}}">
@endsection

@section('content')
    <x-admin.table filter="true" addbutton="{{route('admin.features.create')}}" deletebutton="{{route('admin.features.deleteAll')}}">
            <x-slot name="tableHead">
                <th>
                    <label class="container-checkbox">
                        <input type="checkbox" value="value1" name="name1" id="checkedAll">
                        <span class="checkmark"></span>
                    </label>
                </th>
                <th>#</th>
                <th>{{awtTrans('الصورة')}}</th>
                <th>{{awtTrans('الاسم بالغة العربية')}}</th>
                <th>{{awtTrans('الاسم بالغة الانجلزيه')}}</th>
                <th>{{awtTrans('نوع الميزة')}}</th>
                <th>{{awtTrans('الخيارات')}}</th>
                <th>{{awtTrans('التاريخ')}}</th>
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
                        <td>{{$loop->iteration}}</td>
                        <td><img src="{{$row->image}}" width="50px" height="50px" alt=""></td>
                        <td>{{$row->getTranslations('feature')['ar']}}</td>
                        <td>{{$row->getTranslations('feature')['en']}}</td>
                        <td>{{$row->type->name}}</td>
                        @if(in_array($row->type->type,['radio','select']) )
                        <td>
                            <a href="#" data-toggle="modal" data-target="#exampleModal4"
                               class="btn btn-primary btn-block btn-lg openExtramodal" data-feature="{{$row}}">
                                الخيارات
                            </a>
                        </td>
                        @else
                            <td>النوع المحدد ليس لديه خيارات</td>
                        @endif
                        <td>{{$row->created_at->format('d/m/Y')}}</td>
                        <td class="product-action">
                            <span class="action-edit text-primary"><a href="{{route('admin.features.edit' , ['id' => $row->id])}}"><i class="feather icon-edit"></i></a></span>
                            <span class="delete-row text-danger" data-url="{{url('admin/features/'.$row->id)}}"><i class="feather icon-trash"></i></span>
                        </td>
                    </tr>
                @endforeach
            </x-slot>
        </x-admin.table >
    {{-- #table --}}

    <!-- Edit user Modal -->
    <div class="modal fade" id="exampleModal4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> اضافـة اختيار جديد : <span class="userName"></span> </h5>
                </div>
                <div class="modal-body">
                    <form action="{{route('admin.features.add_option')}}" method="post" enctype="multipart/form-data">

                        <!-- token and user id -->
                        {{csrf_field()}}
                        <input type="hidden" name="feature_id" value="">
                        <!-- /token and user id -->
                        <div class="row">
                            <input type="hidden" name ="_token" value="{{csrf_token()}}" id="token"/>

                            <div class="col-sm-12" style="margin-top: 10px">
                                <label>الاسم با العربيه</label>
                                <input type="text" name="name_ar" class="form-control">
                            </div>

                            <div class="col-sm-12" style="margin-top: 10px">
                                <label>الاسم الانجليزيه</label>
                                <input type="text" name="name_en" class="form-control">
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-sm-12" style="margin-top: 10px">
                                <button type="submit" class="btn btn-primary" >حفظ التعديلات</button>
                            </div>
                        </div>
                    </form>
                    <!-- Modal body -->
                    <hr>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>الاسم بالعربي</th>
                            <th>الاسم بالانجليزي</th>
                            <th>التاريخ</th>
                            <th>حذف</th>
                        </tr>
                        </thead>

                        <tbody class="additions">

                        </tbody>
                    </table>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12" style="margin-top: 10px">
                            <button type="button" class="btn btn-secondary btn btn-danger"
                                    data-dismiss="modal">أغلاق</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Edit user Modal -->
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
    <script src="{{asset('admin/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('admin/app-assets/js/scripts/extensions/sweet-alerts.js')}}"></script>

    {{-- delete all script --}}
        @include('admin.shared.deleteAll')
    {{-- delete all script --}}

    {{-- delete one user script --}}
        @include('admin.shared.deleteOne')
    {{-- delete one user script --}}


    <!-- option -->
    <script type="text/javascript">

        $('.openExtramodal').on('click',function(){
            //get valus
            var feature     = $(this).data('feature')
            //set values in modal inputs
            $("input[name='feature_id']")  .val(feature['id'])

            let additions = '';

            @foreach($options as $option)

            if (feature['id'] == "{{$option->feature_id}}") {

                additions += '<tr>' +
                    '<td>{{$option->getTranslation('name','ar')}}</td>'+
                    '<td>{{$option->getTranslation('name','en')}}</td>'+
                    '<td>{{$option->created_at->diffForHumans()}}</td>' +
                    '<td>' +
                    '<form action="{{route('admin.features.delete_option')}}" method="POST">' +
                    ' {{csrf_field()}}' +
                    '<input type="hidden" name="id" value="{{$option->id}}">' +
                    '<button type="submit" class="generalDelete btn btn-danger">' +
                    ' حذف' +
                    '</button>' +
                    '</form>' +
                    '</td>' +
                    '</tr>';
            }

            @endforeach

            $('.additions').html(additions);
        })

    </script>
    <!-- option -->
@endsection
