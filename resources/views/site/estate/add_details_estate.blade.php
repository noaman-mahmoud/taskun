@extends('site.layouts.master')

@section('content')
    <section class="content orange">
        <!-- banner- section -->
        <div class="banner-section banner-show" style="background-image: url({{url('website/img/banner-home.png')}});">
            <div class="container">
                <div class="info">
                    <p class="title">{{awtTrans('اضافه اعلان')}}</p>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="progress-form">
                <div class="title-show cl-blue">
                    <span class="bg-blue"></span>
                    {{awtTrans('تفاصيل العقار')}}
                </div>
                <div class="pr-bar">
                    <span class="hint">2/5</span>
                    <div role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="50" style="--value:20">
                    </div>
                </div>
            </div>
        </div>

        <div class="form-section">
            <div class="container">
                <form action="{{url('post-add-details-estate')}}" method="post" class="main-form" enctype="multipart/form-data">
                    @csrf

                    @foreach($features as $feature)

                       @if(in_array($feature['type'],['select']))
                          <div class="form-group">
                            <label for="" class="label">{{$feature['name']}}</label>
                            <select name="features[{{$feature['id']}}]" id="" class="select">
                              @foreach($feature['options'] as $options)
                                <option value="{{$options['id']}}">{{$options['name']}}</option>
                              @endforeach
                            </select>
                        </div>
                       @else
                          <div class="form-group input-text">

                            <label for="" class="label">{{$feature['name']}}</label>
                            <input type="{{$feature['type']}}" placeholder="{{$feature['name']}}"
                             name="features[{{$feature['id']}}]" {{$feature['type'] == 'number' ?  'lang="en"' : ''}}>
                         </div>
                       @endif

                    @endforeach

                    <div class="form-group input-multi-check">
                        <label for="" class="label">
                            {{awtTrans('اضافات العقار')}}
                        </label>
                        <div class="custom-label">
                            <div class="row">
                              @foreach($additions as $addition)
                               <div class="col-6 col-md-3">
                                <label class="custom-check">
                                    <input type="checkbox" value="{{$addition->id}}" class="" name="additions[]">
                                    <div class="check-inner">
                                        <span class="box"><i class="fas fa-check"></i></span>
                                        <p class="hint">{{$addition->name}}</p>
                                    </div>
                                </label>
                               </div>
                              @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="title-show cl-blue">
                        <span class="bg-blue"></span>
                        {{awtTrans('تفاصيل أخري')}}
                    </div>

                    <div class="form-group input-text area-text">
                        <label for="" class="label">{{awtTrans('التفاصيل')}}</label>
                        <textarea name="description" placeholder="{{awtTrans('النص التعريفي')}}"></textarea>
                    </div>

                    <button type="submit" class="continue-btn">{{awtTrans('اكمال')}}</button>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        $(document).on('change', '.profile-img-upload input', function (event) {
            if(event.target.files.length > 0) {
                $(this).siblings('img').attr('src', URL.createObjectURL(event.target.files[0]));
                $(this).siblings('img').addClass('single-img');
            } else {
                $(this).siblings('img').attr('src','{{url('website/img/plus-img.png')}}');
                $(this).siblings('img').removeClass('single-img');
            }
        });

        $(document).on("click", ".remove", function () {
            $(this).parent().find(".prev").remove()
            $("#image").val("")
            $(this).remove()
        });
    </script>
    <script>
        $(document).on("keydown", "form", function(event) {
            return event.key != "Enter";
        });
    </script>
@endsection
