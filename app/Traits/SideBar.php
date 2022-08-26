<?php

namespace App\Traits;

use Illuminate\Support\Facades\Route;
use App\Models\Permission;

trait  SideBar
{
    // display routes
    static function sidebar()
    {
        $routes         = Route::getRoutes();
        $routes_data    = [];
        $html = '' ;
        $my_routes      = Permission::where('role_id', auth()->guard('admin')->user()->role_id)->pluck('permission')->toArray();
        foreach ($routes as $route) {
            if ($route->getName())
                $routes_data['"'.$route->getName().'"'] = [
                    'title'     => isset($route->getAction()['title']) ? $route->getAction()['title'] : null,
                    'subTitle'  => isset($route->getAction()['subTitle']) ? $route->getAction()['subTitle'] : null,
                    'icon'      => isset($route->getAction()['icon']) ? $route->getAction()['icon'] : null,
                    'subIcon'   => isset($route->getAction()['subIcon']) ? $route->getAction()['subIcon'] : null,
                    'name'      => $route->getName() ?? null,
                ];
        }


        foreach ($routes as $value) {
            if ($value->getName() !== null) {

                //display only parent routes
                if (isset($value->getAction()['title']) && isset($value->getAction()['icon']) && isset($value->getAction()['type']) && $value->getAction()['type'] == 'parent') {


                    //display route with sub directory
                    if (isset($value->getAction()['sub_route']) && $value->getAction()['sub_route'] == true && isset($value->getAction()['child']) && count($value->getAction()['child'])) {

                        // check user auth to access this route
                        if (in_array($value->getName(), $my_routes)) {


                            //check if this is the current opened
                            $activeLi   = '';
                            $active     = '';
                            $opend      = '';
                            $child_name = substr(Route::currentRouteName(), 6);
                            if(in_array($child_name, $value->getAction()['child'])){
                                $activeLi = 'has-sub sidebar-group-active open';
                                $active = 'active';
                            }

                            $html .= '<li class="nav-item '.$activeLi.'">
                                      <a href="javascript:void(0);">' . $value->getAction()['icon'] . '<span class="menu-title" data-i18n="Dashboard">
                                         ' . awtTrans($value->getAction()['title']) . '</span>
                                      </a>
                                     <ul class="menu-content">';

                            // display child sub directories
                            foreach ($value->getAction()['child'] as $child){
                                $active = ('admin.'.$child) == Route::currentRouteName() ? 'active' : '';


                                if (isset($routes_data['"admin.' . $child . '"']) && $routes_data['"admin.' . $child . '"']['title'] && $routes_data['"admin.' . $child . '"']['icon'])
                                    $html .=  '<li class="'. $active.'"><a href="' . route('admin.'.$child) . '"><i class="feather icon-circle"></i>'. awtTrans($routes_data['"admin.' . $child . '"']['title']) . ' </a></li>';
                            }

                            $html .= '</ul></li>';
                        }
                    } else {

                    if (in_array($value->getName(), $my_routes)) {
                        $active = $value->getName() == Route::currentRouteName() ? 'active' : '';
                        $activeLi ="";
                        $html .= '<li class="nav-item '.$active.'"><a href="' . route($value->getName()) . '"> ' . $value->getAction()['icon'] . '<span class="menu-title" data-i18n="Dashboard">' . awtTrans($value->getAction()['title']) . '</span> <span class="link-text d-flex align-items-center"></a></li>';
                    }
                }
            }
        }
    }
    return $html ;
}

}