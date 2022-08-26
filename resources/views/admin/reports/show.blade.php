@extends('admin.layout.master')
@section('content')
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{awtTrans('عرض التقرير')}}</h4>
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
                                                <label for="first-name-column">{{awtTrans('الرابط')}}</label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" value="{{$row->url}}" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{awtTrans('نوع الاكشن')}}</label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" value="{{$row->method}}" disabled>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{awtTrans('ال ip')}}</label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" value="{{$row->ip}}" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{awtTrans('المتصفح')}}</label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" value="{{$row->agent}}" disabled>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{awtTrans('الادمن')}}</label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" value="{{$row->admin->name}}" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{awtTrans('البريد الالكتروني')}}</label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" value="{{$row->admin->email}}" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{awtTrans('موضوع التقرير')}}</label>
                                                <div class="controls">
                                                    <textarea class="form-control" cols="30" rows="10" disabled>{{$row->subject}}</textarea>
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
