<?php

namespace App\Http\Controllers\Admin;
use App\Http\Requests\Admin\additions\Store;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Traits\Report;
use App\Models\Addition;


class AdditionController extends Controller
{
    /***************************  get all   **************************/
    public function index()
    {
        $rows = Addition::latest()->get();

        return view('admin.additions.index', compact('rows'));
    }

    /***************************  store  **************************/
    public function create()
    {
        return view('admin.additions.create');
    }

    /***************************  store  **************************/
    public function store(Store $request)
    {
        $dataExcept = Arr::except($request->validated(), ['name_ar','name_en','image']);

        $dataExcept['image'] = uploadFile($request->image,'additions');

        $dataExcept['name']  = ['ar'=>$request->name_ar ,'en'=>$request->name_en];

        Addition::create($dataExcept);

        Report::addToLog(' اضافه الاضافه') ;

        return response()->json(['url' => route('admin.additions.index')]);
    }

    /***************************  edit page  **************************/
    public function edit($id)
    {
        $row = Addition::findOrFail($id);
        return view('admin.additions.edit' , ['row' => $row]);
    }

    /***************************  update   **************************/
    public function update(Store $request, $id)
    {
        $row = Addition::findOrFail($id);

        $dataExcept = Arr::except($request->validated(), ['name_ar','name_en','image']);

        $dataExcept['name']  = ['ar'=>$request->name_ar ,'en'=>$request->name_en];

        if (isset($request->image)) $dataExcept['image'] = uploadFile($request->image,'additions');

        $row->update($dataExcept);

        Report::addToLog('  تعديل الاضافه') ;

        return response()->json(['url' => route('admin.additions.index')]);
    }

    /***************************  delete  **************************/
    public function destroy($id)
    {
        $row = Addition::findOrFail($id)->delete();

        Report::addToLog('  حذف الاضافه') ;

        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);

        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (Addition::WhereIn('id',$ids)->delete()) {

            Report::addToLog('  حذف العديد من الاضافات') ;

            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
