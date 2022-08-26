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