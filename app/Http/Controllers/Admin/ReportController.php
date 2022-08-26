<?php

namespace App\Http\Controllers\Admin;

use App\Models\LogActivity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    /***************************  get all   **************************/
    public function index()
    {
        $rows = LogActivity::latest()->get();
        return view('admin.reports.index', compact('rows'));
    }

    /***************************  get all   **************************/
     public function show($id)
     {
         $row = LogActivity::findOrFail($id);
         return view('admin.reports.show', compact('row'));
     }

    /***************************  delete admin  **************************/
    public function destroy($id)
    {
        $admin = LogActivity::findOrFail($id)->delete(); 
        return response()->json(['id' =>$id]);
    }


    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (LogActivity::whereIn('id' , $ids)->delete()) {
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
