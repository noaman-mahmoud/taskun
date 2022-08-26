<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Traits\Menu;
use App\Models\City;
use App\Models\User;
use Carbon\Carbon;
use DB ;

class StatisticsController extends Controller
{
    use Menu;

    public function index(){
        $countryArray   = $this->chartData(new Country);
        $cityArray      = $this->chartData(new City);
        $activeUsers    = User::where(['active' => true])->count() ;
        $notActiveUsers = User::where(['active' => false])->count() ;
        $menus          = $this->home() ;
        $introSiteCards = $this->introSiteCards() ;
        $colores        = ['info' , 'danger' , 'warning' , 'success' , 'primary'];

        return view('admin.statistics.index' , compact('menus' ,'colores' , 'activeUsers' , 'notActiveUsers'  ,'countryArray' , 'cityArray' , 'introSiteCards' ));
    }

    public function chartData($model)
    {
        $users = $model::select('id', 'created_at')
        ->get()
        ->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('m');
        });

        $usermcount = [];
        $userArr = [];

        foreach ($users as $key => $value) {
            $usermcount[(int)$key] = count($value);
        }

        for($i = 1; $i <= 12; $i++){
            $userArr[] = !empty($usermcount[$i]) ? $usermcount[$i] : 0;
        }

        return $userArr ;

    }
}
