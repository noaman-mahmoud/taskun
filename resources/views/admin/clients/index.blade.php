@extends('admin.layout.master')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/vendors/css/tables/datatable/datatables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/vendors/css/tables/datatable/extensions/dataTables.checkboxes.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css-rtl/pages/data-list-view.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css-rtl/core/colors/palette-gradient.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/vendors/css/extensions/sweetalert2.min.css')}}">
@endsection

@section('content')
    {{-- @include('admin.shared.datatables.date-filter') --}}
    {{-- table --}}
        <x-admin.table filter="true"  deletebutton="{{route('admin.clients.deleteAll')}}" extrabuttons="true" >

            <x-slot name="extrabuttonsdiv">
                @if(isset($user))
                <a type="button" data-toggle="modal" data-target="#notify" class="btn bg-gradient-info mr-1 mb-1
                         waves-effect waves-light notify" data-id="all" data-type="{{$user}}">
                    <i class="feather icon-bell"></i>
                    {{awtTrans('ارسال اشعار')}}
                </a>
                @endif
{{--                <a type="button" data-toggle="modal" data-target="#mail" class="btn bg-gradient-success mr-1 mb-1 waves-effect waves-light mail" data-id="all" ><i class="feather icon-mail"></i> {{awtTrans('ارسال ايميل')}}</a>--}}
            </x-slot>

            <x-slot name="tableHead">
                <th>
                    <label class="container-checkbox">
                        <input type="checkbox" value="value1" name="name1" id="checkedAll">
                        <span class="checkmark"></span>
                    </label>
                </th>

                <th>#</th>
                <th>{{awtTrans('الصورة')}}</th>
                <th>{{awtTrans('الاسم')}}</th>
                <th>{{awtTrans('البريد الالكتروني')}}</th>
                <th>{{awtTrans('رقم الهاتف')}}</th>
                <th>{{awtTrans('عدد العقارات')}}</th>
                <th>{{awtTrans('كود التفعيل')}}</th>
                <th>{{awtTrans('حالة الحظر')}}</th>
                <th>{{awtTrans('التفعيل')}}</th>
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
                            <td><img src="{{asset($row->avatar)}}" width="50px" height="50px" alt=""></td>
                            <td>{{$row->name}}</td>
                            <td>{{$row->email}}</td>
                            <td>{{$row->phone}}</td>
                            <td>{{$row->estates_count}}</td>
                            <td>{{$row->code}}</td>
                            <td>
                                @if($row->block)
                                    <span class="btn btn-sm round btn-outline-danger">
                                    {{awtTrans('محظور')}}  <i class="la la-close font-medium-2"></i>
                                </span>
                                @else
                                    <span class="btn btn-sm round btn-outline-success">
                                    {{awtTrans('غير محظور')}}  <i class="la la-check font-medium-2"></i>
                                </span>
                                @endif
                            </td>
                            <td>
                                @if($row->active)
                                    <span class="btn btn-sm round btn-outline-success">
                                    {{awtTrans('مفعل')}}  <i class="la la-close font-medium-2"></i>
                                </span>
                                @else
                                    <span class="btn btn-sm round btn-outline-danger">
                                    {{awtTrans('غير مفعل')}}  <i class="la la-check font-medium-2"></i>
                                </span>
                                @endif
                            </td>
                            <td>{{\Carbon\Carbon::parse($row->created_at)->format('d/m/Y')}}</td>
                            <td class="product-action">
                                <span class="action-edit text-primary"><a href="{{route('admin.clients.edit' , ['id' => $row->id])}}"><i class="feather icon-edit"></i></a></span>
                                <span data-toggle="modal" data-target="#notify" class="text-info notify" data-id="{{$row->id}}" data-url="{{url('admins/clients/notify')}}"><i class="feather icon-bell"></i></span>
{{--                                <span data-toggle="modal" data-target="#mail" class="text-info mail" data-id="{{$row->id}}" data-url="{{url('admins/clients/notify')}}"><i class="feather icon-mail"></i></span>--}}
                                <span class="delete-row text-danger" data-url="{{url('admin/clients/'.$row->id)}}"><i class="feather icon-trash"></i></span>
                            </td>
                        </tr>
                    @endforeach
            </x-slot>
        </x-admin.table >
    {{-- #table --}}

    {{-- notify users model --}}
        <x-admin.NotifyAll route="{{route('admin.clients.notify')}}" />
    {{-- notify users model --}}

@endsection


@section('js')
    <script src="{{asset('admin/app-assets/vendors/js/tables/datatable/datatables.min.js')}}"></script>
    <script src="{{asset('admin/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('admin/app-assets/js/scripts/ui/data-list-view.js')}}"></script>
    <script src="{{asset('admin/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('admin/app-assets/js/scripts/extensions/sweet-alerts.js')}}"></script>

    {{-- delete all script --}}
    @include('admin.shared.deleteAll')
    {{-- delete all script --}}

    {{-- delete one user script --}}
    @include('admin.shared.deleteOne')
    {{-- delete one user script --}}

    {{-- notify one user or all user script --}}
    @include('admin.shared.notify')
    {{-- notify one user or all user script --}}

@endsection
