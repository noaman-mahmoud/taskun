<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\coupons\Store;
use App\Models\Coupon ;
use App\Traits\Report;


class CouponController extends Controller
{
    /***************************  get all   **************************/
    public function index()
    {
        $rows = Coupon::latest()->get();
        return view('admin.coupons.index', compact('rows'));
    }

    /***************************  store  **************************/
    public function create()
    {
        return view('admin.coupons.create');
    }


    /***************************  store  **************************/
    public function store(Store $request)
    {
        Coupon::create($request->except(['expire_date']) + (['expire_date' => date('Y-m-d H:i:s', strtotime($request->expire_date))]));
        Report::addToLog('  اضافه كوبون خصم') ;
        return response()->json(['url' => route('admin.coupons.index')]);
    }

    /***************************  edit page  **************************/
    public function edit($id)
    {
        $row = Coupon::findOrFail($id);
        return view('admin.coupons.edit' , ['row' => $row]);
    }

    /***************************  update   **************************/
    public function update(Store $request, $id)
    {
        $row = Coupon::findOrFail($id)->update($request->except(['expire_date'])  + (['expire_date' => date('Y-m-d H:i:s', strtotime($request->expire_date))]));
        Report::addToLog('  تعديل كوبون خصم') ;
        return response()->json(['url' => route('admin.coupons.index')]);
    }

    /***************************  delete  **************************/
    public function destroy($id)
    {
        $row = Coupon::findOrFail($id)->delete();
        Report::addToLog('  حذف كوبون خصم') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (Coupon::WhereIn('id',$ids)->delete()) {
            Report::addToLog('  حذف العديد من كوبونات الخصم') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }

    public function renew(Request $request)
    {
        $coupon = Coupon::findOrFail($request->id) ;
        if ($request->status == 'closed') {
            $coupon->update(['status' => 'closed']) ; 
            $html = '<span class="btn btn-sm round btn-outline-success open-coupon" data-toggle="modal" id="div_'.$coupon->id.'" data-target="#notify" data-id="'.$coupon->id.'"> 
                        '.awtTrans('اعاده تنشيط الكوبون').'  <i class="feather icon-rotate-cw"></i>
                    </span>'
                    ;
        }else{
            $coupon->update($request->except(['expire_date'])  + ([ 'expire_date' => date('Y-m-d H:i:s', strtotime($request->expire_date))]));
            $html = '<span class="btn btn-sm round btn-outline-danger change-coupon-status" data-status="closed" data-id="'.$coupon->id.'"> 
                        '.awtTrans('ايقاف الكوبون').'  <i class="feather icon-slash"></i>
                    </span>';
        } 
        
        return response()->json(['message' => awtTrans('تم تحديث حالة الكوبون بنجاح') , 'html' => $html , 'id' => $request->id]) ; 
    }
}
