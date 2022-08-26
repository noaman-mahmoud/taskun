<?php

namespace App\Http\Controllers\Admin;
use App\Http\Requests\Admin\housingtypes\Store;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\HousingType;
use App\Models\EstateType;
use App\Traits\Report;


class HousingTypeController extends Controller
{
    /***************************  get all   **************************/
    public function index()
    {
        $rows = HousingType::with('estateType')->latest()->get();

        return view('admin.housingtypes.index', compact('rows'));
    }

    /***************************  store  **************************/
    public function create()
    {
        $types =  EstateType::where(['deleted' => 0])->latest()->get();
        return view('admin.housingtypes.create', get_defined_vars());
    }


    /***************************  store  **************************/
    public function store(Store $request)
    {
        $dataExcept = Arr::except($request->validated(), ['name_ar','name_en']);

        $dataExcept['estate_type_id'] = $request->estate_type_id;
        $dataExcept['name']  = ['ar'=>$request->name_ar ,'en'=>$request->name_en];

        HousingType::create($dataExcept);

        Report::addToLog(' اضافه السكن') ;

        return response()->json(['url' => route('admin.housingtypes.index')]);
    }

    /***************************  edit page  **************************/
    public function edit($id)
    {
        $row   = HousingType::findOrFail($id);
        $types =  EstateType::where(['deleted' => 0])->latest()->get();
        
        return view('admin.housingtypes.edit', get_defined_vars());
    }

    /***************************  update   **************************/
    public function update(Store $request, $id)
    {
        $row = HousingType::findOrFail($id);

        $dataExcept = Arr::except($request->validated(), ['name_ar','name_en']);

        $dataExcept['name']  = ['ar'=>$request->name_ar ,'en'=>$request->name_en];

        $dataExcept['estate_type_id'] = $request->estate_type_id;

        $row->update($dataExcept);

        Report::addToLog('  تعديل السكن') ;

        return response()->json(['url' => route('admin.housingtypes.index')]);
    }

    /***************************  delete  **************************/
    public function destroy($id)
    {
        $row = HousingType::findOrFail($id)->delete();

        Report::addToLog('  حذف السكن') ;

        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);

        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (HousingType::WhereIn('id',$ids)->delete()) {

            Report::addToLog('  حذف العديد من المساكن') ;

            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
