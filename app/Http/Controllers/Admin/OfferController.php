<?php

namespace App\Http\Controllers\Admin;
use App\Http\Requests\Admin\offers\Store;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Traits\Report;
use App\Models\Offer;


class OfferController extends Controller
{
    /***************************  get all   **************************/
    public function index()
    {
        $rows = Offer::latest()->get();
        return view('admin.offers.index', compact('rows'));
    }

    /***************************  store  **************************/
    public function create()
    {
        return view('admin.offers.create');
    }


    /***************************  store  **************************/
    public function store(Store $request)
    {
        $dataExcept = Arr::except($request->validated(), ['name_ar','name_en','image']);

        $dataExcept['image'] = uploadFile($request->image,'offers');

//        $dataExcept['name']  = ['ar'=>$request->name_ar ,'en'=>$request->name_en];

        Offer::create($dataExcept);

        Report::addToLog(' اضافه العروض') ;

        return response()->json(['url' => route('admin.offers.index')]);
    }

    /***************************  edit page  **************************/
    public function edit($id)
    {
        $row = Offer::findOrFail($id);
        return view('admin.offers.edit' , ['row' => $row]);
    }

    /***************************  update   **************************/
    public function update(Store $request, $id)
    {
        $row = Offer::findOrFail($id);

        $dataExcept = Arr::except($request->validated(), ['name_ar','name_en','image']);

        $dataExcept['name']  = ['ar'=>$request->name_ar ,'en'=>$request->name_en];

        if (isset($request->image)) $dataExcept['image'] = uploadFile($request->image,'offers');

        $row->update($dataExcept);

        Report::addToLog('  تعديل العروض') ;

        return response()->json(['url' => route('admin.offers.index')]);
    }

    /***************************  delete  **************************/
    public function destroy($id)
    {
        $row = Offer::findOrFail($id)->delete();

        Report::addToLog('  حذف العروض') ;

        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);

        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (Offer::WhereIn('id',$ids)->delete()) {

            Report::addToLog('  حذف العديد من عرض') ;

            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
