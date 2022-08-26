
<div class="content-body">
    <div class="all-buttons">
        <div class="table_buttons">
            @isset($addbutton)
                <a href="{{$addbutton}}" class="btn bg-gradient-primary mr-1 mb-1 waves-effect waves-light" ><i class="feather icon-plus"></i> {{awtTrans('اضافة')}}</a>
            @endisset
            @isset($deletebutton)
                    <button type="button" data-route="{{$deletebutton}}" class="btn bg-gradient-danger mr-1 mb-1 waves-effect waves-light delete_all_button"><i class="feather icon-trash"></i> {{awtTrans('حذف المحدد')}}</button>
            @endisset
            @isset($extrabuttons)
                {{$extrabuttonsdiv}}
            @endif
            <button type="button" class="reload btn bg-gradient-warning mr-1 mb-1 waves-effect waves-light"><i class="feather icon-refresh-cw"></i> {{awtTrans('تحديث')}}</button>
        </div>
{{--        @isset($filter)--}}
{{--            <div class="filter d-flex">--}}
{{--                <input class="form-control mr-1" name="min" id="min" type="text" placeholder="{{awtTrans('بداية التاريخ')}}" >--}}
{{--                <input class="form-control" name="max" id="max" type="text" placeholder="{{awtTrans('نهاية التاريخ')}}" >--}}
{{--            </div>--}}
{{--        @endisset--}}
    </div>
    <!-- Data list view starts -->
    <section id="data-list-view" class="data-list-view-header">
        <div class="table-responsive">
            <table class="table data-list-view" data-page-length="20">
                <thead>
                    <tr>
                        {{$tableHead}}
                    </tr>
                </thead>
                <tbody>
                    {{$tableBody}}
                </tbody>
            </table>
        </div>
        <!-- DataTable ends -->
    </section>
    <!-- Data list view end -->

</div>
