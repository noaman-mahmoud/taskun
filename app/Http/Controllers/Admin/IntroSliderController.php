<?php

namespace App\Http\Controllers\Admin;

use App\Traits\Report;
use App\Models\IntroSlider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\IntroSliders\Store;

class IntroSliderController extends Controller
{
    /***************************  get all   **************************/
    public function index()
    {
        $rows = IntroSlider::get();
        return view('admin.introsliders.index', compact('rows'));
    }

    /***************************  store  **************************/
    public function create()
    {
        return view('admin.introsliders.create');
    }

    /***************************  store  **************************/
    public function store(Store $request)
    {
        IntroSlider::create($request->validated()+ ([
            'title' => ['ar' => $request->title_ar , 'en' => $request->title_en] , 
            'description' => ['ar' => $request->description_ar , 'en' => $request->description_en]
        ]));
        Report::addToLog('اضافة صورة لقسم البنرات الخاص بالموقع التعريفي') ;
        return response()->json(['url' => route('admin.introsliders.index')]);
    }

    /***************************  store  **************************/
    public function edit($id)
    {
        $row = IntroSlider::findOrFail($id);
        return view('admin.introsliders.edit' , ['row' => $row]);
    }

    /***************************  update   **************************/
    public function update(Store $request, $id)
    {
        IntroSlider::findOrFail($id)->update($request->validated()+ ([
            'title' => ['ar' => $request->title_ar , 'en' => $request->title_en] , 
            'description' => ['ar' => $request->description_ar , 'en' => $request->description_en]
        ]));
        Report::addToLog('تعديل صورة في قسم البنرات الخاص بالموقع التعريفي') ;
        return response()->json(['url' => route('admin.introsliders.index')]);
    }

    /***************************  delete  **************************/
    public function destroy($id)
    {
        IntroSlider::findOrFail($id)->delete();
        Report::addToLog('حذف صورة من قسم البنرات الخاص بالموقع التعريفي') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (IntroSlider::whereIn('id' , $ids)->delete($ids)) {
            Report::addToLog('حذف مجموعه من الصور في قسم البنرات الخاص بالموقع التعريفي') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
