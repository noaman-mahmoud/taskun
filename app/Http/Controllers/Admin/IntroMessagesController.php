<?php

namespace App\Http\Controllers\Admin;

use App\Traits\Report;
use Illuminate\Http\Request;
use App\Models\IntroMessages;
use App\Http\Controllers\Controller;

class IntroMessagesController extends Controller
{
    /***************************  get all   **************************/
    public function index()
    {
        $rows = IntroMessages::latest()->get();
        return view('admin.intromessages.index', compact('rows'));
    }

    /***************************  get all   **************************/
    public function show($id)
    {
        $row = IntroMessages::findOrFail($id);
        return view('admin.intromessages.show', compact('row'));
    }

    /***************************  delete  **************************/
    public function destroy($id)
    {
        IntroMessages::findOrFail($id)->delete();
        Report::addToLog('حذف رسالة خاصه من الرسائل المرسلة للموقع التعريفي') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (IntroMessages::whereIn('id' , $ids)->delete()) {
            Report::addToLog('حذف العديد من الرسائل الخاصه من الرسائل المرسلة للموقع التعريفي') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
