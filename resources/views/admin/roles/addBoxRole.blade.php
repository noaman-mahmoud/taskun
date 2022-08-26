@php  $html = "" ; @endphp
<div class="col-md-3">
    <div class="card permissionCard package bg-white shadow">
        <div class="role-title text-white">
            <div>
                <div class="icheck-primary d-inline">
                    <input type="checkbox" name="permissions[]" value="{{$value->getName()}}" id="{{$parent_class}}" class="roles-parent">
                    <label for="{{$parent_class}}" dir="ltr"></label>
                </div>
                <label class="text-white" for="{{$parent_class}}">{{ awtTrans($value->getAction()["title"])}}</label>
            </div>
        </div>

        @if (isset($value->getAction()['child']) && count($value->getAction()['child']))
            {!! $html .= '<ul class="list-unstyled">' !!}
            @foreach ($value->getAction()['child'] as $key => $child)
                <li>
                    <div class="form-group clearfix">
                        <div class="icheck-primary d-inline">
                            <input type="checkbox"  name="permissions[]" value="admin.' {{$child}} '"  id="{{$value->getName() . $key}}" class="{{$parent_class}}">
                            <label  for="{{$value->getName() . $key }}" dir="ltr"></label>
                        </div>
                        <label class="title_lable" for="{{$value->getName() . $key }}">
                            {{awtTrans($routes_data['"admin.' . $child . '"']['title'])}}
                        </label>
                    </div>
                </li>
            @endforeach
            {!! $html .= '</ul>' !!}
        @endif
    </div>
</div>