<?php

namespace App\Http\Controllers\Admin;

use App\Traits\Report;
use Illuminate\Http\Request;
use App\Models\IntroPartener;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\IntroParteners\Store;

class IntroPartenerController extends Controller
{
    /***************************  get all   **************************/
    public function index()
    {
        $rows = IntroPartener::latest()->get();
        return view('admin.introparteners.index', compact('rows'));
    }
    /***************************  store  **************************/
    public function create()
    {
        return view('admin.introparteners.create');
    }


    /***************************  store  **************************/
    public function store(Store $request)
    {
        IntroPartener::create($request->validated());
        Report::addToLog('  اضافه شريك لقسم شركائنا في العمل') ;
        return response()->json(['url' => route('admin.introparteners.index')]);
    }

    /***************************  store  **************************/
    public function edit($id)
    {
        $row = IntroPartener::findOrFail($id);
        return view('admin.introparteners.edit' , ['row' => $row]);
    }

    /***************************  update   **************************/
    public function update(Store $request, $id)
    {
        IntroPartener::findOrFail($id)->update($request->validated());
        Report::addToLog('  تعديل شريك  في قسم شركائنا في العمل') ;
        return response()->json(['url' => route('admin.introparteners.index')]);
    }

    /***************************  delete  **************************/
    public function destroy($id)
    {
        IntroPartener::findOrFail($id)->delete();
        Report::addToLog('  حذف شريك  من قسم شركائنا في العمل') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (IntroPartener::whereIn('id' , $ids)->delete()) {
            Report::addToLog('  حذف مجموعه من الشركاء  من قسم شركائنا في العمل') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
