<?php

namespace App\Http\Controllers\Admin;
use App\Http\Requests\Admin\copys\Store;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Traits\Report;
use App\Models\Copy;


class CopyController extends Controller
{
    /***************************  get all   **************************/
    public function index()
    {
        $rows = Copy::latest()->get();
        return view('admin.copys.index', compact('rows'));
    }

    /***************************  store  **************************/
    public function create()
    {
        return view('admin.copys.create');
    }


    /***************************  store  **************************/
    public function store(Store $request)
    {
        $dataExcept = Arr::except($request->validated(), ['name_ar','name_en','image']);

        $dataExcept['image'] = uploadFile($request->image,'copys');

        $dataExcept['name']  = ['ar'=>$request->name_ar ,'en'=>$request->name_en];

        Copy::create($dataExcept);

        Report::addToLog(' اضافه arsinglesame') ;

        return response()->json(['url' => route('admin.copys.index')]);
    }

    /***************************  edit page  **************************/
    public function edit($id)
    {
        $row = Copy::findOrFail($id);
        return view('admin.copys.edit' , ['row' => $row]);
    }

    /***************************  update   **************************/
    public function update(Store $request, $id)
    {
        $row = Copy::findOrFail($id);

        $dataExcept = Arr::except($request->validated(), ['name_ar','name_en','image']);

        $dataExcept['name']  = ['ar'=>$request->name_ar ,'en'=>$request->name_en];

        if (isset($request->image)) $dataExcept['image'] = uploadFile($request->image,'copys');

        $row->update($dataExcept);

        Report::addToLog('  تعديل arsinglesame') ;

        return response()->json(['url' => route('admin.copys.index')]);
    }

    /***************************  delete  **************************/
    public function destroy($id)
    {
        $row = Copy::findOrFail($id)->delete();

        Report::addToLog('  حذف arsinglesame') ;

        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);

        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (Copy::WhereIn('id',$ids)->delete()) {

            Report::addToLog('  حذف العديد من arpluraleName') ;
            
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
