<?php

namespace App\Http\Controllers\Admin;
use App\Http\Requests\Admin\Client\AddEditClientRequest;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Jobs\NotifyUser;
use App\Jobs\BlockUser;
use App\Traits\Report;
use App\Models\User;
use App\Models\City;
use Carbon\Carbon;
use Route;

class ClientController extends Controller
{

    /***************************  get all clients  **************************/
    public function index(Request $request)
    {
        if ($request->ajax()) return $this->prepareDatatable($request);

        $route = Route::currentRouteName();

        $users = [
           'owner'    =>'admin.clients.index',
           'office'   =>'admin.clients.offices',
           'marketer' =>'admin.clients.marketers',
        ];

        $user = array_search($route, $users);
        $rows = User::withCount('estates')->where('user_type',$user)->get();

        return view('admin.clients.index' ,compact('rows','user'));
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

    /***************************  get active clients  **************************/
    public function active(Request $request)
    {
        $rows   = User::where(['active' => true])->get();
        return view('admin.clients.index',compact('rows'));
    }

    /***************************  get not active clients  **************************/
    public function notActive()
    {
        $rows = User::where(['active' => false])->get();
        return view('admin.clients.index', compact('rows'));
    }

    /***************************  get active clients  **************************/
    public function block()
    {
        $rows = User::where(['block' => true])->get();
        return view('admin.clients.index', compact('rows'));
    }

    /***************************  get active clients  **************************/
    public function notBlock()
    {
        $rows = User::where(['block' => false])->get();
        return view('admin.clients.index', compact('rows'));
    }

     /***************************  store  **************************/
     public function create()
     {
         return view('admin.clients.create');
     }

    /***************************  store client **************************/
    public function store(AddEditClientRequest $request)
    {
        User::create($request->all());
        Report::addToLog('  اضافه مستخدم') ;
        return response()->json(['url' => route('admin.clients.index')]);
    }

    /***************************  store  **************************/
    public function edit($id)
    {
        $row   = User::findOrFail($id);
        $cites = City::latest()->get();

        return view('admin.clients.edit',compact('row','cites'));
    }

    /***************************  update client  **************************/
    public function update(AddEditClientRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->validated());

        Report::addToLog('  تعديل مستخدم') ;

        $users = [
            'admin.clients.index'     => 'owner',
            'admin.clients.offices'   => 'office',
            'admin.clients.marketers' => 'marketer',
        ];

        $route = array_search($user->user_type , $users );

        return response()->json(['url' => route($route)]);
    }

    /***************************  delete client **************************/
    public function destroy($id)
    {
        $user = User::findOrFail($id)->delete();
        Report::addToLog('  حذف مستخدم') ;
        return response()->json(['id' =>$id]);
    }

    public function blockUser($id)
    {
        $user = User::findOrFail($id);
        dispatch(new BlockUser($user));
        return redirect()->back()->with('success', 'تم حظر المستخدم بنجاح');
    }

    public function notify(Request $request)
    {
        if ($request->id == 'all'){
            $type    = 'all';
            $clients = User::where('user_type',$request->type)->get();
        }else{
            $type    = 'user';
            $clients = User::findOrFail($request->id);
        }

        dispatch(new NotifyUser($clients, $request , $type));
        return response()->json();
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);

        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (User::whereIn('id' , $ids)->delete()) {
            Report::addToLog('  حذف العديد من المستخدمين') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
