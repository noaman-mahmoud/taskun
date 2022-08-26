<?php

namespace App\Http\Controllers\Admin;
use App\Http\Requests\Admin\providers\Store;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Jobs\NotifyUser;
use App\Traits\Report;
use App\Models\User;
use App\Models\City;
use Carbon\Carbon;
use Route;


class ProviderController extends Controller
{
    /***************************  get all   **************************/
    public function index(Request $request)
    {
        if ($request->ajax()){

            return $this->prepareDatatable($request);
        }

        $route  = Route::currentRouteName();
        $active = str_contains($route, 'active') ? 1 : 0 ;

        $rows   = User::where(['user_type'=>'provider','activation_admin'=>$active])->latest()->get();


        return view('admin.providers.index', compact('rows'));
    }

    public function prepareDatatable($data = []){
        $rows     = User::query();

        if(!is_null($data['min']) && !is_null($data['max']))
            $rows = $rows->whereBetween('created_at', [$data['min'], $data['max']]);

        return DataTables::of($rows)
            ->addColumn('id', function ($row) {
                return (string) view('admin.shared.datatables.checkbox'     , compact('row'));
            })
            ->addColumn('created_at', function($row){
                return    '<td>'. Carbon::parse($row->created_at)->format('d/m/Y').'</td>';
            })
            ->addColumn('image', function($row){
                return   '<td><a target="_blank" href="'.$row->avatar.'"><img src="'.$row->avatar.'" width="50px" height="50px" alt=""></a></td>';
            })
            ->addColumn('phone', function($row){
                return   '<td><a href="tel:'.$row->phone.'">'.$row->phone.'</a></td>';
            })
            ->addColumn('email', function($row){
                return    '<td><a href="mailto:'.$row->email.'">'.$row->email.'</a></td>';
            })
            ->addColumn('block', function ($row) {
                return (string) view('admin.shared.datatables.user.block'   , compact('row'));
            })
            ->addColumn('activate', function ($row) {
                return (string) view('admin.shared.datatables.user.block'   , compact('row'));
            })
            ->addColumn('controls', function ($row) {
                return (string) view('admin.shared.datatables.user.controls', compact('row'));
            })
            ->rawColumns(['id','created_at','image','phone','email','block','activate','controls'])
            ->make(true);
    }

    /***************************  store  **************************/
    public function create()
    {
        return view('admin.providers.create');
    }

    /***************************  store  **************************/
    public function store(Store $request)
    {
        $dataExcept = Arr::except($request->validated(), ['name_ar','name_en','image']);

        $dataExcept['image'] = uploadFile($request->image,'providers');

        $dataExcept['name']  = ['ar'=>$request->name_ar ,'en'=>$request->name_en];

        User::create($dataExcept);

        Report::addToLog(' اضافه المقدم') ;

        return response()->json(['url' => route('admin.providers.index')]);
    }

    /***************************  edit page  **************************/
    public function edit($id)
    {
        $cities = City::latest()->get();
        $row    = User::findOrFail($id);

        return view('admin.providers.edit' ,compact('row','cities'));
    }

    /***************************  update   **************************/
    public function update(Store $request, $id)
    {
        $row = User::findOrFail($id);

        $dataExcept = Arr::except($request->validated(), ['id_image']);

        if (isset($request->id_image)) $dataExcept['id_image'] = uploadFile($request->id_image,'id_images');

        $row->update($dataExcept);

        Report::addToLog(' تعديل المقدم') ;

        $route = $row->activation_admin == 1 ?  'admin.providers.active' : 'admin.providers.pending';

        return response()->json(['url' => route($route)]);
    }

    /***************************  delete  **************************/
    public function destroy($id)
    {
        $row = User::findOrFail($id)->delete();

        Report::addToLog('  حذف المقدم') ;

        return response()->json(['id' =>$id]);
    }

    public function notify(Request $request)
    {

        if ($request->id == 'all'){
            $providers = User::where('user_type','provider')->get();
        }else{
            $providers = User::where('user_type','provider')->findOrFail($request->id);
        }

        dispatch(new NotifyUser($providers, $request , $request->type));

        return response()->json();
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);

        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (User::WhereIn('id',$ids)->delete()) {

            Report::addToLog('  حذف العديد من المقدمين') ;

            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
