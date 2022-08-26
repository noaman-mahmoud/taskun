<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\images\Store;
use App\Models\Image ;
use App\Traits\Report;


class ImageController extends Controller
{
    /***************************  get all   **************************/
    public function index()
    {
        $rows = Image::latest()->get();
        return view('admin.images.index', compact('rows'));
    }

    /***************************  store  **************************/
    public function create()
    {
        return view('admin.images.create');
    }


    /***************************  store  **************************/
    public function store(Store $request)
    {
        Image::create($request->validated() + ([
            'title' => ['ar' => $request->title_ar , 'en' => $request->title_en] , 
            'description' => ['ar' => $request->description_ar , 'en' => $request->description_en]
        ]));
        Report::addToLog('  اضافه بانر_اعلاني') ;
        return response()->json(['url' => route('admin.images.index')]);
    }

    /***************************  edit page  **************************/
    public function edit($id)
    {
        $row = Image::findOrFail($id);
        return view('admin.images.edit' , ['row' => $row]);
    }

    /***************************  update   **************************/
    public function update(Store $request, $id)
    {
        $row = Image::findOrFail($id)->update($request->validated() + ([
            'title' => ['ar' => $request->title_ar , 'en' => $request->title_en] , 
            'description' => ['ar' => $request->description_ar , 'en' => $request->description_en]
        ]));
        Report::addToLog('  تعديل بانر_اعلاني') ;
        return response()->json(['url' => route('admin.images.index')]);
    }

    /***************************  delete  **************************/
    public function destroy($id)
    {
        $row = Image::findOrFail($id)->delete();
        Report::addToLog('  حذف بانر_اعلاني') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (Image::WhereIn('id',$ids)->delete()) {
            Report::addToLog('  حذف العديد من البنرات_الاعلانية') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
