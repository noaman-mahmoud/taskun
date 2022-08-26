<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Traits\Roles;
use App\Traits\Report;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Role\Create;

class RoleController extends Controller
{
    use Roles ; 
    /***************************  get all roles  **************************/
    public function index()
    {
        $rows = Role::get();
        return view('admin.roles.index', compact('rows'));
    }

    /***************************  get all roles  **************************/
    public function create()
    {
        $html = $this->addRole();
        return view('admin.roles.create' , compact('html'));
    }

    /***************************  get all roles  **************************/
    public function store(Create $request)
    {
        if(!$request->permissions){
            return back()->with('danger', 'يجب اختيار صلاحيه واحده علي الاقل ');
        }
        $role = Role::create($request->all());

        $permissions = [];
        foreach ($request->permissions ?? [] as $permission)
            $permissions[]['permission'] = $permission;

        $role->permissions()->createMany($permissions);
        Report::addToLog('  اضافه صلاحية') ;
        return redirect(route('admin.roles.index'))->with('success', 'تم الاضافه بنجاح');
    }

    /***************************  get all roles  **************************/
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $html = $this->editRole($id);
        return view('admin.roles.edit', compact('role' , 'html'));
    }

    /***************************  get all roles  **************************/
    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $role->update($request->all());
        
        $role->permissions()->delete();
        $permissions = [];
        foreach ($request->permissions ?? [] as $permission)
            $permissions[]['permission'] = $permission;

        $role->permissions()->createMany($permissions);
        Report::addToLog('  تعديل صلاحية') ;

        return redirect(route('admin.roles.index'))->with('success', 'تم التعديل بنجاح');
    }

    /***************************  destroy  **************************/
    public function destroy($id)
    {
        $role = Role::findOrFail($id)->delete();
        Report::addToLog('  حذف صلاحية') ;
        return response()->json(['id' =>$id]);
    }
}
