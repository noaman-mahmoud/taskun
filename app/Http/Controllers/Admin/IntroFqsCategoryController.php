<?php

namespace App\Http\Controllers\Admin;

use App\Traits\Report;
use Illuminate\Http\Request;
use App\Models\IntroFqsCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\IntroFqsCategories\Store;

class IntroFqsCategoryController extends Controller
{
    /***************************  get all   **************************/
    public function index()
    {
        $rows = IntroFqsCategory::latest()->get();
        return view('admin.introfqscategories.index', compact('rows'));
    }

    /***************************  store  **************************/
    public function create()
    {
        return view('admin.introfqscategories.create');
    }
    /***************************  store  **************************/
    public function store(Store $request)
    {
        IntroFqsCategory::create($request->validated() + (['title' => ['ar' => $request->title_ar , 'en' => $request->title_en]])) ;
        Report::addToLog('  اضافه قسم للاسئلة الشائعه الخاصه بالموقع التعريفي') ;
        return response()->json(['url' => route('admin.introfqscategories.index')]);
    }

    /***************************  store  **************************/
    public function edit($id)
    {
        $row = IntroFqsCategory::findOrFail($id);
        return view('admin.introfqscategories.edit' , ['row' => $row]);
    }

    /***************************  update   **************************/
    public function update(Store $request, $id)
    {
        IntroFqsCategory::findOrFail($id)->update($request->validated() + (['title' => ['ar' => $request->title_ar , 'en' => $request->title_en]]));
        Report::addToLog('  تعديل قسم للاسئلة الشائعه الخاصه بالموقع التعريفي') ;
        return response()->json(['url' => route('admin.introfqscategories.index')]);
    }

    /***************************  delete  **************************/
    public function destroy($id)
    {
        IntroFqsCategory::findOrFail($id)->delete();
        Report::addToLog('  حذف قسم للاسئلة الشائعه الخاصه بالموقع التعريفي') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (IntroFqsCategory::whereIn('id' , $ids)->delete()) {
            Report::addToLog('  حذف العديد من الاقسام للاسئلة الشائعه الخاصه بالموقع التعريفي') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
