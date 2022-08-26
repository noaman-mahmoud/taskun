<?php

namespace App\Http\Controllers\Admin;
use App\Http\Requests\Admin\banktransfers\Store;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Traits\Report;
use App\Models\BankTransfer;


class BankTransferController extends Controller
{
    /***************************  get all   **************************/
    public function index()
    {
        $rows = BankTransfer::latest()->get();
        return view('admin.bankTransfers.index', compact('rows'));
    }

    /***************************  store  **************************/
    public function create()
    {
        return view('admin.bankTransfers.create');
    }


    /***************************  store  **************************/
    public function store(Store $request)
    {
        $dataExcept = Arr::except($request->validated(), ['name_ar','name_en','image']);

        $dataExcept['image'] = uploadFile($request->image,'BankTransfers');

        $dataExcept['name']  = ['ar'=>$request->name_ar ,'en'=>$request->name_en];

        BankTransfer::create($dataExcept);

        Report::addToLog(' اضافه الحوالات') ;

        return response()->json(['url' => route('admin.bank-transfers.index')]);
    }

    /***************************  edit page  **************************/
    public function edit($id)
    {
        $row = BankTransfer::findOrFail($id);
        return view('admin.bankTransfers.edit' , ['row' => $row]);
    }

    /***************************  update   **************************/
    public function update(Store $request, $id)
    {
        $row = BankTransfer::findOrFail($id);

        $dataExcept = Arr::except($request->validated(), ['name_ar','name_en','image']);

        $dataExcept['name']  = ['ar'=>$request->name_ar ,'en'=>$request->name_en];

        if (isset($request->image)) $dataExcept['image'] = uploadFile($request->image,'BankTransfers');

        $row->update($dataExcept);

        Report::addToLog('  تعديل الحوالات') ;

        return response()->json(['url' => route('admin.bank-transfers.index')]);
    }

    /***************************  delete  **************************/
    public function destroy($id)
    {
        $row = BankTransfer::findOrFail($id)->delete();

        Report::addToLog('  حذف الحوالات') ;

        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);

        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (BankTransfer::WhereIn('id',$ids)->delete()) {

            Report::addToLog('  حذف العديد من الحوالة') ;

            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
