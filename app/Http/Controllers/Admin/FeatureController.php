<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\features\Store;
use Illuminate\Support\Arr;
use App\Models\InputType;
use App\Models\Feature;
use App\Models\Option;
use App\Traits\Report;


class FeatureController extends Controller
{
    /***************************  get all   **************************/
    public function index()
    {
        $rows    = Feature::with(['type'])->latest()->get();
        $options = Option::latest()->get();

        return view('admin.features.index', get_defined_vars());
    }

    /***************************  store  **************************/
    public function create()
    {
        $types = InputType::latest()->get();

        return view('admin.features.create',compact('types'));
    }


    /***************************  store  **************************/
    public function store(Store $request)
    {
        $dataExcept = Arr::except($request->validated(), ['name_ar','name_en','image']);

        $dataExcept['image']   = uploadFile($request->image,'features');

        $dataExcept['feature'] = ['ar'=>$request->name_ar ,'en'=>$request->name_en];

        Feature::create($dataExcept);

        Report::addToLog('اضافه المميزات') ;

        return response()->json(['url' => route('admin.features.index')]);
    }

    /**  public function add option . */
    public function add_option(Request $request)
    {
        $this->validate($request, [
            'name_ar' => 'required|min:2|max:190',
            'name_en' => 'required|min:2|max:190',
        ],[
            'name_ar.required' =>'يجب ادخال الاسم بالغه العربيه',
            'name_en.required' =>'يجب ادخال الاسم بالغه الانجلزيه',
        ]);

         Option::create([
            'feature_id' => $request->feature_id,
            'name'       => ['ar' => $request->name_ar, 'en' => $request->name_en],
        ]);

        Report::addToLog('اضافه خيارات') ;


        return back()->with('success','تم اضافه الخيار بنجاح');
    }

    /**  public function delete option . */
    public function delete_option(Request $request)
    {
        $option = Option::findOrFail($request->id);
        $option->delete();

        return back()->with('success','تم حذف الخيار بنجاح');
    }

    /***************************  edit page  **************************/
    public function edit($id)
    {
        $row   = Feature::findOrFail($id);
        $types = InputType::latest()->get();

        return view('admin.features.edit' , get_defined_vars());
    }

    /***************************  update   **************************/
    public function update(Store $request, $id)
    {
        $row = Feature::findOrFail($id);

        $dataExcept = Arr::except($request->validated(), ['name_ar','name_en','image']);

        if (isset($request->image)) $dataExcept['image'] = uploadFile($request->image,'features');

        $dataExcept['feature']  = ['ar'=>$request->name_ar ,'en'=>$request->name_en];

        $row->update($dataExcept);

        Report::addToLog('  تعديل المميزات') ;

        return response()->json(['url' => route('admin.features.index')]);
    }

    /***************************  delete  **************************/
    public function destroy($id)
    {
        $row = Feature::findOrFail($id)->delete();

        Report::addToLog('  حذف المميزات') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);

        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (Feature::WhereIn('id',$ids)->delete()) {
            Report::addToLog('  حذف العديد من arpluraleName') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
