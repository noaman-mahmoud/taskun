<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\countries\Store;
use App\Models\Country ;
use App\Traits\Report;


class CountryController extends Controller
{
    /***************************  get all   **************************/
    public function index()
    {
        $rows = Country::latest()->get();
        return view('admin.countries.index', compact('rows'));
    }

    /***************************  store  **************************/
    public function create()
    {
        return view('admin.countries.create');
    }


    /***************************  store  **************************/
    public function store(Store $request)
    {
        Country::create($request->validated() + ([
            'name' => ['ar' => $request->name_ar , 'en' => $request->name_en] , 
        ]));
        Report::addToLog('  اضافه بلد') ;
        return response()->json(['url' => route('admin.countries.index')]);
    }

    /***************************  edit page  **************************/
    public function edit($id)
    {
        $row = Country::findOrFail($id);
        return view('admin.countries.edit' , ['row' => $row]);
    }

    /***************************  update   **************************/
    public function update(Store $request, $id)
    {
        $row = Country::findOrFail($id)->update($request->validated() + ([
            'name' => ['ar' => $request->name_ar , 'en' => $request->name_en] , 
        ]));
        Report::addToLog('  تعديل بلد') ;
        return response()->json(['url' => route('admin.countries.index')]);
    }

    /***************************  delete  **************************/
    public function destroy($id)
    {
        $row = Country::findOrFail($id)->delete();
        Report::addToLog('  حذف بلد') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (Country::WhereIn('id',$ids)->delete()) {
            Report::addToLog('  حذف العديد من البلاد') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
