<?php

namespace App\Http\Controllers\Admin;

use App\Traits\Report;
use App\Models\IntroSocial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\IntroSocials\Store;

class IntroSocialController extends Controller
{
    /***************************  get all   **************************/
    public function index()
    {
        $rows = IntroSocial::get();
        return view('admin.introsocials.index', compact('rows'));
    }

    /***************************  store  **************************/
    public function create()
    {
        return view('admin.introsocials.create');
    }

    /***************************  store  **************************/
    public function store(Store $request)
    {
        IntroSocial::create($request->validated());
        Report::addToLog('  اضافه وسيلة تواصل لقسم وسائل التواصل الخاصة بالموقع التعريفي') ;
        return response()->json(['url' => route('admin.introsocials.index')]);
    }

    /***************************  store  **************************/
    public function edit($id)
    {
        $row = IntroSocial::findOrFail($id);
        return view('admin.introsocials.edit' , ['row' => $row]);
    }

    /***************************  update   **************************/
    public function update(Store $request, $id)
    {
        IntroSocial::findOrFail($id)->update($request->validated());
        Report::addToLog('  تعديل وسيلة تواصل  في قسم وسائل التواصل الخاصة بالموقع التعريفي') ;
        return response()->json(['url' => route('admin.introsocials.index')]);
    }

    /***************************  delete  **************************/
    public function destroy($id)
    {
        IntroSocial::findOrFail($id)->delete();
        Report::addToLog('  حذف وسيلة تواصل  من قسم وسائل التواصل الخاصة بالموقع التعريفي') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (IntroSocial::whereIn('id' , $ids)->delete()) {
            Report::addToLog('  حذف محموعه من وسائل التواصل  من قسم وسائل التواصل الخاصة بالموقع التعريفي') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
