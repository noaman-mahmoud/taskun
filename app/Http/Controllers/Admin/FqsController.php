<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\fqs\Store;
use App\Models\Fqs ;
use App\Traits\Report;


class FqsController extends Controller
{
    /***************************  get all   **************************/
    public function index()
    {
        $rows = Fqs::latest()->get();
        return view('admin.fqs.index', compact('rows'));
    }

    /***************************  store  **************************/
    public function create()
    {
        return view('admin.fqs.create');
    }


    /***************************  store  **************************/
    public function store(Store $request)
    {
        Fqs::create($request->validated() + ([
            'question' => ['ar' => $request->question_ar , 'en' => $request->question_en] , 
            'answer' => ['ar' => $request->answer_ar , 'en' => $request->answer_en]
        ]));
        Report::addToLog('  اضافه سؤال') ;
        return response()->json(['url' => route('admin.fqs.index')]);
    }

    /***************************  edit page  **************************/
    public function edit($id)
    {
        $row = Fqs::findOrFail($id);
        return view('admin.fqs.edit' , ['row' => $row]);
    }

    /***************************  update   **************************/
    public function update(Store $request, $id)
    {
        $row = Fqs::findOrFail($id)->update($request->validated() + ([
            'question' => ['ar' => $request->question_ar , 'en' => $request->question_en] , 
            'answer' => ['ar' => $request->answer_ar , 'en' => $request->answer_en]
        ]));
        Report::addToLog('  تعديل سؤال') ;
        return response()->json(['url' => route('admin.fqs.index')]);
    }

    /***************************  delete  **************************/
    public function destroy($id)
    {
        $row = Fqs::findOrFail($id)->delete();
        Report::addToLog('  حذف سؤال') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (Fqs::WhereIn('id',$ids)->delete()) {
            Report::addToLog('  حذف العديد من الاسئلة_الشائعة') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
