<?php

namespace App\Http\Controllers\Admin;

use App\Traits\Report;
use App\Models\IntroFqs;
use Illuminate\Http\Request;
use App\Models\IntroFqsCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\IntroFqs\Store;

class IntroFqsController extends Controller
{
    /***************************  get all   **************************/
    public function index()
    {
        $rows = IntroFqs::latest()->get();
        return view('admin.introfqs.index', compact('rows'));
    }
    /***************************  store  **************************/
    public function create()
    {
        $categories = IntroFqsCategory::get() ;
        return view('admin.introfqs.create', compact('categories'));
    }


    /***************************  store  **************************/
    public function store(Store $request)
    {
        IntroFqs::create($request->validated() + ([
                'title' => ['ar' => $request->title_ar , 'en' => $request->title_en] , 
                'description' => ['ar' => $request->description_ar , 'en' => $request->description_en]
            ])) ;
        Report::addToLog('  اضافه سؤال شائع الخاص بالموقع التعريفي') ;
        return response()->json(['url' => route('admin.introfqs.index')]);
    }

    /***************************  store  **************************/
    public function edit($id)
    {
        $row = IntroFqs::findOrFail($id);
        $categories = IntroFqsCategory::get() ;

        return view('admin.introfqs.edit' , ['row' => $row , 'categories' => $categories]);
    }
    /***************************  update   **************************/
    public function update(Store $request, $id)
    {
        IntroFqs::findOrFail($id)->update($request->validated() + ([
            'title' => ['ar' => $request->title_ar , 'en' => $request->title_en] , 
            'description' => ['ar' => $request->description_ar , 'en' => $request->description_en]
        ])) ;
        Report::addToLog('  تعديل سؤال شائع الخاص بالموقع التعريفي') ;
        return response()->json(['url' => route('admin.introfqs.index')]);
    }

    /***************************  delete  **************************/
    public function destroy($id)
    {
        IntroFqs::findOrFail($id)->delete();
        Report::addToLog('  حذف سؤال شائع الخاص بالموقع التعريفي') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (IntroFqs::whereIn('id' , $ids)->delete()) {
            Report::addToLog('  حذف العديد من الاسئلة الشائعة الخاصة بالموقع التعريفي') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
