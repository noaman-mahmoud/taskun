<?php

namespace App\Http\Controllers\Admin;
use App\Http\Requests\Admin\estatetypes\Store;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Traits\Report;
use App\Models\EstateType;


class EstateTypeController extends Controller
{
    /***************************  get all   **************************/
    public function index()
    {
        $rows = EstateType::where(['deleted'=>0])->latest()->get();
        return view('admin.estatetypes.index', compact('rows'));
    }

    /***************************  store  **************************/
    public function create()
    {
        return view('admin.estatetypes.create');
    }


    /***************************  store  **************************/
    public function store(Store $request)
    {
        $dataExcept = Arr::except($request->validated(), ['name_ar','name_en']);

        $dataExcept['name']  = ['ar'=>$request->name_ar ,'en'=>$request->name_en];

        EstateType::create($dataExcept);

        Report::addToLog(' اضافه نوع عقار') ;

        return response()->json(['url' => route('admin.estatetypes.index')]);
    }

    /***************************  edit page  **************************/
    public function edit($id)
    {
        $row = EstateType::findOrFail($id);
        return view('admin.estatetypes.edit' , ['row' => $row]);
    }

    /***************************  update   **************************/
    public function update(Store $request, $id)
    {
        $row = EstateType::findOrFail($id);

        $dataExcept = Arr::except($request->validated(), ['name_ar','name_en']);

        $dataExcept['name']  = ['ar'=>$request->name_ar ,'en'=>$request->name_en];

        $row->update($dataExcept);

        Report::addToLog('  تعديل نوع العقار') ;

        return response()->json(['url' => route('admin.estatetypes.index')]);
    }

    /***************************  delete  **************************/
    public function destroy($id)
    {
        $row = EstateType::findOrFail($id)->update(['deleted'=>1]);

        Report::addToLog('  حذف نوع العقار') ;

        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);

        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (EstateType::WhereIn('id',$ids)->update(['deleted'=>1])) {

            Report::addToLog('  حذف العديد من انواع العقارات') ;

            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
