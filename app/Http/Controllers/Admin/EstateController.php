<?php

namespace App\Http\Controllers\Admin;
use App\Http\Requests\Admin\estates\Store;
use App\Repositories\EstateRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EstateFeature;
use Illuminate\Support\Arr;
use App\Models\Feature;
use App\Models\Estate;
use App\Traits\Report;
use App\Models\City;


class EstateController extends Controller
{
    private $EstateRepository;

    public function __construct(EstateRepository $EstateRepository)
    {
        $this->EstateRepository   = $EstateRepository;
    }

    /***************************  get all   **************************/
    public function index()
    {
        $rows = Estate::with(['provider'])->latest()->get();
        return view('admin.estates.index', compact('rows'));
    }

    /***************************  store  **************************/
    public function create()
    {
        return view('admin.estates.create');
    }


    /***************************  store  **************************/
    public function store(Store $request)
    {
        Estate::create($request->validated() + ([
            'title' => ['ar' => $request->name_ar , 'en' => $request->name_en] ,
            'description' => ['ar' => $request->description_ar , 'en' => $request->description_en]
        ]));

        Report::addToLog('  اضافه عقار') ;
        return response()->json(['url' => route('admin.estates.index')]);
    }

    /***************************  edit page  **************************/
    public function edit($id)
    {
        $row       = Estate::with(['provider','city','estateCategory','category','likes'])->findOrFail($id);
        $data      = $this->EstateRepository->estate_details($row);
        
        return view('admin.estates.edit' , get_defined_vars());
    }

    /***************************  update   **************************/
    public function update(Store $request, $id)
    {
        $dataExcept = Arr::except($request->validated(),
            ['image','name_ar','name_en','description_ar','description_en','features']
        );

        $dataExcept['description'] = ['ar' => $request->description_ar , 'en' => $request->description_en];
        $dataExcept['name']        = ['ar' => $request->name_ar , 'en' => $request->name_en];
        $dataExcept['price']       = convert2english($request->price);

        if (isset($request->image)){

            $dataExcept['image']  = uploadFile($request->image,'estate_images');
        }

         Estate::findOrFail($id)->update($dataExcept);

        if (isset($request->features)){

            $features = array_keys($request->features);

            foreach ($request->numbers as $key => $value){

                if (in_array($key , $features )){

                     EstateFeature::updateOrCreate([
                        'estate_id'   => $id,
                        'feature_id'  => $key,
                    ],[
                        'estate_id'   => $id,
                        'feature_id'  => $key,
                        'number'      => $value,
                    ]);
                }
            }

            EstateFeature::where('estate_id',$id)->whereNotIn('feature_id',$features)->delete();
        }

        Report::addToLog('  تعديل عقار') ;
        return response()->json(['url' => route('admin.estates.index')]);
    }

    /***************************  delete  **************************/
    public function destroy($id)
    {
        $row = Estate::findOrFail($id)->delete();
        Report::addToLog('  حذف عقار') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);

        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (Estate::WhereIn('id',$ids)->delete()) {
            Report::addToLog('  حذف العديد من عقارات') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
