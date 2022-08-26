<?php

namespace App\Http\Controllers\Admin;
use App\Http\Requests\Admin\accounttypes\Store;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Traits\Report;
use App\Models\AccountType;


class AccountTypeController extends Controller
{
    /***************************  get all   **************************/
    public function index()
    {
        $rows = AccountType::get();
        return view('admin.account_types.index', compact('rows'));
    }

    /***************************  store  **************************/
    public function create()
    {
        return view('admin.account_types.create');
    }


    /***************************  store  **************************/
    public function store(Store $request)
    {
        $data = ['name_ar','name_en','description_ar','description_en','account_ar','account_en'];
        $dataExcept = Arr::except($request->validated(),$data);

        $dataExcept['name']         = ['ar'=>$request->name_ar ,'en'=>$request->name_en];
        $dataExcept['description']  = ['ar'=>$request->description_ar ,'en'=>$request->description_en];
        $dataExcept['account']      = ['ar'=>$request->account_ar ,'en'=>$request->account_en];

        AccountType::create($dataExcept);

        Report::addToLog(' اضافه الحساب') ;

        return response()->json(['url' => route('admin.accounttypes.index')]);
    }

    /***************************  edit page  **************************/
    public function edit($id)
    {
        $row = AccountType::findOrFail($id);
        return view('admin.account_types.edit' , ['row' => $row]);
    }

    /***************************  update   **************************/
    public function update(Store $request, $id)
    {
        $row  = AccountType::findOrFail($id);

        $data = ['description_ar','description_en','account_ar','account_en'];

        $dataExcept = Arr::except($request->validated(),$data);

//        $dataExcept['name']         = ['ar'=>$request->name_ar ,'en'=>$request->name_en];
        $dataExcept['description']  = ['ar'=>$request->description_ar ,'en'=>$request->description_en];
        $dataExcept['account']      = ['ar'=>$request->account_ar ,'en'=>$request->account_en];

        $row->update($dataExcept);

        Report::addToLog('  تعديل الحساب') ;

        return response()->json(['url' => route('admin.accounttypes.index')]);
    }

    /***************************  delete  **************************/
    public function destroy($id)
    {
        $row = AccountType::findOrFail($id)->delete();

        Report::addToLog('  حذف الحساب') ;

        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);

        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (AccountType::WhereIn('id',$ids)->delete()) {

            Report::addToLog('  حذف العديد من الحسابات') ;

            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
