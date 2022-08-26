<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\Admin;
use App\Traits\Report;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Admin\Create;
use App\Http\Requests\Admin\Admin\Update;


class AdminController extends Controller
{


    public function notifications()
    {
        auth('admin')->user()->unreadNotifications->markAsRead();
        return view('admin.admins.notifications');

    }
    public function deleteNotifications(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }

        auth('admin')->user()->notifications()->whereIn('id', $ids)->delete() ; 
        return response()->json();
    }



    /***************************  get all admins  **************************/
    public function index()
    {
        $rows = Admin::latest()->get();
        return view('admin.admins.index', compact('rows'));
    }
    /***************************  store  **************************/
    public function create()
    {
        $roles = Role::latest()->get();
        return view('admin.admins.create', compact('roles'));
    }

    /***************************  store admin **************************/
    public function store(Create $request)
    {
        Admin::create($request->all());
        Report::addToLog('  اضافه مدير') ;
        return response()->json(['url' => route('admin.admins.index')]);
    }

    
    /***************************  store  **************************/
    public function edit($id)
    {
        $row = Admin::findOrFail($id);
        $roles = Role::latest()->get();
        return view('admin.admins.edit' , ['row' => $row , 'roles' => $roles]);
    }

    /***************************  update admin  **************************/
    public function update( $id , Update $request)
    {
        $admin = Admin::findOrFail($id);
        $admin->update($request->validated());
        Report::addToLog('  تعديل مدير') ;
        return response()->json(['url' => route('admin.admins.index')]);
    }

    /***************************  delete admin  **************************/
    public function destroy($id)
    {
        $admin = Admin::findOrFail($id)->delete();
        Report::addToLog('  حذف مدير') ;
        return response()->json(['id' =>$id]);
    }


    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (Admin::whereIn('id' , $ids)->delete()) {
            Report::addToLog('  حذف العديد من المديرين') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
