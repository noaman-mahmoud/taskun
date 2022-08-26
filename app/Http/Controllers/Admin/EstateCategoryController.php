<?php

namespace App\Http\Controllers\Admin;
use App\Http\Requests\Admin\EstateCategory\Store;
use App\Http\Controllers\Controller;
use App\Models\EstateCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Traits\Report;


class EstateCategoryController extends Controller
{
    /***************************  get all   **************************/
    public function index()
    {
        $rows = EstateCategory::latest()->get();

        return view('admin.estate_categories.index', compact('rows'));
    }

    /***************************  store  **************************/
    public function create()
    {
        return view('admin.estate_categories.create');
    }


    /***************************  store  **************************/
    public function store(Store $request)
    {
        $dataExcept = Arr::except($request->validated(), ['name_ar','name_en']);

        $dataExcept['name']  = ['ar'=>$request->name_ar ,'en'=>$request->name_en];

        EstateCategory::create($dataExcept);

        Report::addToLog(' اضافه فئات') ;

        return response()->json(['url' => route('admin.estate-categories.index')]);
    }

    /***************************  edit page  **************************/
    public function edit($id)
    {
        $row = EstateCategory::findOrFail($id);
        return view('admin.estate_categories.edit' , ['row' => $row]);
    }

    /***************************  update   **************************/
    public function update(Store $request, $id)
    {
        $row = EstateCategory::findOrFail($id);

        $dataExcept = Arr::except($request->validated(), ['name_ar','name_en','image']);

        $dataExcept['name']  = ['ar'=>$request->name_ar ,'en'=>$request->name_en];

        $row->update($dataExcept);

        Report::addToLog(' تعديل فئات') ;

        return response()->json(['url' => route('admin.estate-categories.index')]);
    }

    /***************************  delete  **************************/
    public function destroy($id)
    {
        $row = EstateCategory::findOrFail($id)->delete();

        Report::addToLog('  حذف فئات') ;

        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);

        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (EstateCategory::WhereIn('id',$ids)->delete()) {

            Report::addToLog('  حذف العديد من فئة') ;

            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
