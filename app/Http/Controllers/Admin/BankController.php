<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\banks\Store;
use Illuminate\Http\Request;
use App\Traits\Report;
use App\Models\Bank;
use Illuminate\Support\Arr;


class BankController extends Controller
{
    /***************************  get all   **************************/
    public function index()
    {
        $rows = Bank::latest()->get();

        return view('admin.banks.index', compact('rows'));
    }

    /***************************  store  **************************/
    public function create()
    {
        return view('admin.banks.create');
    }


    /***************************  store  **************************/
    public function store(Store $request)
    {
        $dataExcept = Arr::except($request->validated(), ['image']);

        $dataExcept['image'] = uploadFile($request->image,'banks');

        $dataExcept['account_number'] = convert2english($request->account_number);
        $dataExcept['iban_number']    = convert2english($request->iban_number);

        Bank::create($dataExcept);

        Report::addToLog('اضافه حساب بنكي') ;

        return response()->json(['url' => route('admin.banks.index')]);
    }

    /***************************  edit page  **************************/
    public function edit($id)
    {
        $row = Bank::findOrFail($id);
        
        return view('admin.banks.edit' , ['row' => $row]);
    }

    /***************************  update   **************************/
    public function update(Store $request, $id)
    {
        $row = Bank::findOrFail($id);

        $dataExcept = Arr::except($request->validated(), ['image']);

        $dataExcept['account_number'] = convert2english($request->account_number);
        $dataExcept['iban_number']    = convert2english($request->iban_number);

        if (isset($request->image)) $dataExcept['image'] = uploadFile($request->image,'banks');

        $row->update($dataExcept);

        Report::addToLog('  تعديل بنوك') ;
        return response()->json(['url' => route('admin.banks.index')]);
    }

    /***************************  delete  **************************/
    public function destroy($id)
    {
        $row = Bank::findOrFail($id)->delete();
        Report::addToLog('  حذف بنوك') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);

        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (Bank::WhereIn('id',$ids)->delete()) {
            Report::addToLog('  حذف العديد من بنك') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
