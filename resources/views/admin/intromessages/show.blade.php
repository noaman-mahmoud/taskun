@extends('admin.layout.master')
@section('content')
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{awtTrans('عرض الرسالة')}}</h4>
                    </div>

                    <div class="card-content">
                        <div class="card-body">
                            <form >
                                @csrf
                                @method('PUT')
                                <div class="form-body">
                                    <div class="row">

                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{awtTrans('اسم المستخدم')}}</label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" value="{{$row->name}}" disabled>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{awtTrans('رقم الهاتف')}}</label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" value="{{$row->phone}}" disabled >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{awtTrans('البريد الالكتروني')}}</label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" value="{{$row->email}}" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{awtTrans('نص الرسالة')}}</label>
                                                <div class="controls">
                                                    <textarea class="form-control" cols="30" rows="10" disabled>{{$row->message}}</textarea>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-12 d-flex justify-content-center mt-3">
                                            <a href="{{ url()->previous() }}" type="reset" class="btn btn-outline-warning mr-1 mb-1">{{awtTrans(' رجوع ')}}</a>
                                        </div>

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
