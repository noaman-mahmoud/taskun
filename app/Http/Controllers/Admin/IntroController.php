<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\intros\Store;
use App\Models\Intro ;
use App\Traits\Report;


class IntroController extends Controller
{
    /***************************  get all   **************************/
    public function index()
    {
        $rows = Intro::latest()->get();
        return view('admin.intros.index', compact('rows'));
    }

    /***************************  store  **************************/
    public function create()
    {
        return view('admin.intros.create');
    }


    /***************************  store  **************************/
    public function store(Store $request)
    {
        Intro::create($request->validated() + ([
            'title' => ['ar' => $request->title_ar , 'en' => $request->title_en] , 
            'description' => ['ar' => $request->description_ar , 'en' => $request->description_en]
        ]));
        Report::addToLog('  اضافه صفحة_تعريفية') ;
        return response()->json(['url' => route('admin.intros.index')]);
    }

    /***************************  edit page  **************************/
    public function edit($id)
    {
        $row = Intro::findOrFail($id);
        return view('admin.intros.edit' , ['row' => $row]);
    }

    /***************************  update   **************************/
    public function update(Store $request, $id)
    {
        $row = Intro::findOrFail($id)->update($request->validated() + ([
            'title' => ['ar' => $request->title_ar , 'en' => $request->title_en] , 
            'description' => ['ar' => $request->description_ar , 'en' => $request->description_en]
        ]));
        Report::addToLog('  تعديل صفحة_تعريفية') ;
        return response()->json(['url' => route('admin.intros.index')]);
    }

    /***************************  delete  **************************/
    public function destroy($id)
    {
        $row = Intro::findOrFail($id)->delete();
        Report::addToLog('  حذف صفحة_تعريفية') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (Intro::WhereIn('id',$ids)->delete()) {
            Report::addToLog('  حذف العديد من الصفحات_التعريفية') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
