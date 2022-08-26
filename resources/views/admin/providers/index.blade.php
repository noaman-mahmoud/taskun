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
{{--    <x-admin.table filter="true"  addbutton="{{route('admin.providers.create')}}" deletebutton="{{route('admin.providers.deleteAll')}}" extrabuttons="true" >--}}
    <x-admin.table filter="true"  deletebutton="{{route('admin.providers.deleteAll')}}" extrabuttons="true" >

        <x-slot name="extrabuttonsdiv">
            <a type="button" data-toggle="modal" data-target="#notify" class="btn bg-gradient-info mr-1 mb-1 waves-effect waves-light notify" data-id="all" >
                <i class="feather icon-bell"></i> {{awtTrans('ارسال اشعار')}}
            </a>

            <a type="button" data-toggle="modal" data-target="#mail" class="btn bg-gradient-success mr-1 mb-1 waves-effect waves-light mail" data-id="all" >
                <i class="feather icon-mail"></i> {{awtTrans('ارسال ايميل')}}
            </a>
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
                        <span class="action-edit text-primary"><a href="{{route('admin.providers.edit' , ['id' => $row->id])}}"><i class="feather icon-edit"></i></a></span>
                        <span data-toggle="modal" data-target="#notify" class="text-info notify" data-id="{{$row->id}}" data-url="{{url('admins/providers/notify')}}"><i class="feather icon-bell"></i></span>
{{--                        <span data-toggle="modal" data-target="#mail" class="text-info mail" data-id="{{$row->id}}" data-url="{{url('admins/providers/notify')}}"><i class="feather icon-mail"></i></span>--}}
                        <span class="delete-row text-danger" data-url="{{url('admin/providers/'.$row->id)}}"><i class="feather icon-trash"></i></span>
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-admin.table >
    {{-- #table --}}

    {{-- notify users model --}}
    <x-admin.NotifyAll route="{{route('admin.providers.notify')}}" />
    {{-- notify users model --}}

@endsection


@section('js')
    <script src="{{asset('admin/app-assets/vendors/js/tables/datatable/datatables.min.js')}}"></script>
    <script src="{{asset('admin/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('admin/app-assets/js/scripts/ui/data-list-view.js')}}"></script>
    <script src="{{asset('admin/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('admin/app-assets/js/scripts/extensions/sweet-alerts.js')}}"></script>


    {{-- @if(!isset($rows))
      <script type="text/javascript">
        $(document).ready(function() {
            "use strict"

            var dataListView =  initDatatable();

            dataListView.on('draw.dt', function(){
                setTimeout(function(){
                    if (navigator.userAgent.indexOf("Mac OS X") != -1) {
                        $(".dt-checkboxes-cell input, .dt-checkboxes").addClass("mac-checkbox")
                    }
                }, 50);
            });

        $('.minFilter').datepicker({
            dateFormat: 'yy-mm-dd'
        });
        $('.maxFilter').datepicker({
            dateFormat: 'yy-mm-dd'
        });

        $('#doDateSearch').click( function(e) {
               e.preventDefault();
               var min = $('.minFilter').val()
               var max = $('.maxFilter').val()
               initDatatable(min,max)
        });
        });

      function initDatatable(min,max){
          $('#DataTables_Table_0').DataTable().destroy();
         return   $("#DataTables_Table_0").DataTable({
              responsive: true,
              processing: true,
              serverSide: true,
              "ajax"    : {
                  "url" : "{{ route('admin.providers.index') }}",
                  "data": {
                      min  : min,
                      max  : max,
                  }
              },
              columns: [
                  {data: 'id'         , name: 'id'},
                  {data: 'created_at' , name: 'created_at'},
                  {data: 'image'      , name: 'image'},
                  {data: 'name'       , name: 'name'},
                  {data: 'email'      , name: 'email'},
                  {data: 'phone'      , name: 'phone'},
                  {data: 'block'      , name: 'block'},
                  {data: 'activate'   , name: 'activate'},
                  {data: 'controls'   , name: 'controls'},
              ],
              columnDefs: [
                  {
                      orderable: true,
                      targets: 0,
                      checkboxes: { selectRow: true }
                  }
              ],
              dom:
                  '<"top"<"actions action-btns"B><"action-filters"lf>><"clear">rt<"bottom"<"actions">p>',
              oLanguage: {
                  sLengthMenu: "_MENU_",
                  sSearch: ""
              },
              aLengthMenu: [[4, 10, 15, 20], [4, 10, 15, 20]],
              select: {
                  style: "multi"
              },
              order: [[1, "asc"]],
              bInfo: false,
              searching : true,
              pageLength: 4,
              buttons: [
                  {
                      text: "<i class='feather icon-plus'></i> Add New",
                      action: function() {
                          $(this).removeClass("btn-secondary")
                          $(".add-new-data").addClass("show")
                          $(".overlay-bg").addClass("show")
                          $("#data-name, #data-price").val("")
                          $("#data-category, #data-status").prop("selectedIndex", 0)
                      },
                      className: "btn-outline-primary"
                  }
              ],
              initComplete: function(settings, json) {
                  $(".dt-buttons .btn").removeClass("btn-secondary")
              }
          });
      }
      </script>
    @endif --}}
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
