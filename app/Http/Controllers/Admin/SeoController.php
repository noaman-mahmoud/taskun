<?php

namespace App\Http\Controllers\Admin;

use App\Models\Seo;
use App\Traits\Report;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Seo\Create;

class SeoController extends Controller
{
    /***************************  get all  **************************/
    public function index()
    {
        $rows = Seo::get();
        return view('admin.seos.index', compact('rows'));
    }
    /***************************  store  **************************/
    public function create()
    {
        return view('admin.seos.create');
    }

    /***************************  store  **************************/
    public function store(Create $request)
    {
        Seo::create($request->validated() + ([
            'meta_title'        => ['ar' => $request->meta_title_ar , 'en' => $request->meta_title_en] , 
            'meta_description'  => ['ar' => $request->meta_description_ar , 'en' => $request->meta_description_en] ,
            'meta_keywords'     => ['ar' => $request->meta_keywords_ar , 'en' => $request->meta_keywords_en]
        ]));
        Report::addToLog('اضافه seo') ;
        return response()->json(['url' => route('admin.seos.index')]);
    }

    /***************************  store  **************************/
    public function edit($id)
    {
        $row = Seo::findOrFail($id);
        return view('admin.seos.edit' , ['row' => $row]);
    }
    /***************************  update  **************************/
    public function update(Create $request, $id)
    {
        Seo::findOrFail($id)->update($request->validated() + ([
            'meta_title'        => ['ar' => $request->meta_title_ar , 'en' => $request->meta_title_en] , 
            'meta_description'  => ['ar' => $request->meta_description_ar , 'en' => $request->meta_description_en] ,
            'meta_keywords'     => ['ar' => $request->meta_keywords_ar , 'en' => $request->meta_keywords_en]
        ]));
        Report::addToLog('تعديل seo') ;
        return response()->json(['url' => route('admin.seos.index')]);
    }

    /***************************  delete admin  **************************/
    public function destroy($id)
    {
        $admin = Seo::findOrFail($id)->delete();
        Report::addToLog('حذف seo') ;
        return response()->json(['id' =>$id]);
    }


    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (Seo::whereIn('id' , $ids)->delete()) {
            Report::addToLog('حذف مجموعه من ال seo') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }

}
