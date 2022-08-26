<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\categories\Store;
use App\Models\Category ;
use App\Traits\Report;


class CategoryController extends Controller
{
    /***************************  get all   **************************/
    public function index($id = null)
    {
        $rows = Category::where('parent_id' , $id)->latest()->get();
        return view('admin.categories.index', compact('rows' , 'id'));
    }

    /***************************  store  **************************/
    public function create($id = null)
    {
        $categories = Category::latest()->get();
        return view('admin.categories.create' , compact('categories' , 'id'));
    }


    /***************************  store  **************************/
    public function store(Store $request)
    {
        Category::create($request->validated() + ([
            'name' => ['ar' => $request->name_ar , 'en' => $request->name_en] ,
        ]));
        Report::addToLog('  اضافه قسم') ;
        return response()->json(['url' => route('admin.categories.index')]);
    }

    /***************************  edit page  **************************/
    public function edit($id)
    {
        $row = Category::findOrFail($id);
        $categories = Category::latest()->get();
        return view('admin.categories.edit' , ['row' => $row , 'categories' => $categories]);
    }

    /***************************  update   **************************/
    public function update(Store $request, $id)
    {
        $row = Category::findOrFail($id)->update($request->validated() + ([
            'name' => ['ar' => $request->name_ar , 'en' => $request->name_en] ,
        ]));
        Report::addToLog('  تعديل قسم') ;
        return response()->json(['url' => route('admin.categories.index')]);
    }

    /***************************  delete  **************************/
    public function destroy($id)
    {
        $row = Category::findOrFail($id)->delete();
        Report::addToLog('  حذف قسم') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);

        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (Category::WhereIn('id',$ids)->delete()) {
            Report::addToLog('  حذف العديد من الاقسام') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
