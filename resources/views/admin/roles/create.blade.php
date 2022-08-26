@extends('admin.layout.master')
@section('css')
    <style>
        .permissionCard{
        border: 0;
        margin-bottom: 13px;
        }

        .role-title{
        background: #5d54d4;
        padding: 12px;
        border-radius: 7px;
        /* margin-bottom: 10px; */
        }

        .list-unstyled{
        padding: 10px;
        height: 300px;
            /* scroll-behavior: smooth; */
            overflow: auto;
        }

        .selectP{
            margin-right: 10px;
            margin-top: 11px;
        }
        .title_lable{
            color: #4762dd ;
        }
</style>
@endsection
@section('content')
<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{awtTrans('اضافه صلاحية ')}}</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form action="{{route('admin.roles.store')}}" method="post">
                            @csrf
                            <div class="container mt-2">
                                <div style="display: flex; flex-direction: row-reverse; align-items: center">
                                    <p class="selectP">{{awtTrans('تحديد الكل')}}</p>
                                    <input type="checkbox" id="checkedAll">
                                </div>
                            </div>
                            <div class="container mt-2">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>{{awtTrans('الاسم بالعربية')}}</label>
                                            <input type="text" name="name_ar" class="form-control" placeholder="{{awtTrans('ادخل الاسم بالعربية')}}" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>{{awtTrans('الاسم بالانجليزية')}}</label>
                                            <input type="text" name="name_en" class="form-control" placeholder="{{awtTrans('ادخل الاسم بالانجليزية')}}" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="container mt-2">
                                <div class="row">
                                    {!! $html !!}
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-center mt-3">
                                <button type="submit" class="btn btn-primary mr-1 mb-1 submit_button">{{awtTrans('اضافة')}}</button>
                                <a href="{{ url()->previous() }}" type="reset" class="btn btn-outline-warning mr-1 mb-1">{{awtTrans(' رجوع ')}}</a>
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
    <script>
        $(function () {
            $('.roles-parent').change(function () {

                var childClass = '.' + $(this).attr('id');
                if (this.checked) {

                    $(childClass).prop("checked", true);

                } else {

                    $(childClass).prop("checked", false);
                }
            });
        });


        $("#checkedAll").change(function () {
            if (this.checked) {
                $("input[type=checkbox]").each(function () {
                    this.checked = true
                })
            } else {
                $("input[type=checkbox]").each(function () {
                    this.checked = false;
                })
            }
        });
    </script>
@endsection

