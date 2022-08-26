<?php

namespace App\Http\Controllers\Admin;

use App\Models\City ;
use App\Traits\Report;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\cities\Store;
use Illuminate\Support\Arr;


class CityController extends Controller
{
//    hyper split
    /***************************  get all   **************************/
    public function index()
    {
        $rows = City::with('country')->latest()->get();

        return view('admin.cities.index', compact('rows'));
    }

    /***************************  store  **************************/
    public function create()
    {
        $countries = Country::get() ;
        return view('admin.cities.create' , compact('countries'));
    }


    /***************************  store  **************************/
    public function store(Store $request)
    {
        $dataExcept = Arr::except($request->validated(), ['name_ar','name_en']);

        $dataExcept['name']  = ['ar'=>$request->name_ar ,'en'=>$request->name_en];

        City::create($dataExcept);

        Report::addToLog('اضافه مدينة') ;
        
        return response()->json(['url' => route('admin.cities.index')]);
    }

    /***************************  edit page  **************************/
    public function edit($id)
    {
        $countries = Country::get() ;
        $row = City::findOrFail($id);
        return view('admin.cities.edit' , ['row' => $row , 'countries' => $countries]);
    }

    /***************************  update   **************************/
    public function update(Store $request, $id)
    {
        $row = City::findOrFail($id);

        $dataExcept = Arr::except($request->validated(), ['name_ar','name_en']);

        $dataExcept['name']  = ['ar'=>$request->name_ar ,'en'=>$request->name_en];

        $row->update($dataExcept);

        Report::addToLog('  تعديل مدينة') ;

        return response()->json(['url' => route('admin.cities.index')]);
    }

    /***************************  delete  **************************/
    public function destroy($id)
    {
        $row = City::findOrFail($id)->delete();
        Report::addToLog('  حذف مدينة') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);

        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (City::WhereIn('id',$ids)->delete()) {
            Report::addToLog('  حذف العديد من المدن') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
