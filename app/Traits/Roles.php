<?php

namespace App\Traits;
use Illuminate\Support\Facades\Route;
use App\Models\Permission;

trait  Roles
{
    function addRole()
    {
        $routes = Route::getRoutes();
        $routes_data = [];
        $id   = 0;
        $html = '' ;

        foreach ($routes as $route)
          if ($route->getName())
                $routes_data['"'. $route->getName() .'"'] =
                      ['title' => isset($route->getAction()['title']) ? $route->getAction()['title'] : null ];

          foreach ($routes as $value) {
            if (isset($value->getAction()['title']) && isset($value->getAction()['type']) && $value->getAction()['type'] == 'parent') {
                $parent_class = 'gtx_' . $id++;
                $html .= view('admin.roles.addBoxRole',get_defined_vars());
            }
         }
        return $html ;
    }
    

    function editRole($id)
    {

        $routes         = Route::getRoutes();
        $routes_data    = [];
        $my_routes      = Permission::where('role_id', $id)->pluck('permission')->toArray();
        $id = 0;
        $html = '' ;
        foreach ($routes as $route)
            if ($route->getName())
                $routes_data['"' . $route->getName() . '"'] = ['title' => isset($route->getAction()['title']) ? $route->getAction()['title'] : null];

        foreach ($routes as $value) {

            if (isset($value->getAction()['title']) && isset($value->getAction()['type']) && $value->getAction()['type'] == 'parent') {

                $select = in_array($value->getName(), $my_routes)  ? 'checked' : '';
                $parent_class = 'gtx_' . $id++;
                $html .= view('admin.roles.EditBoxRole',get_defined_vars());
            }
        }
        return $html ;
    }

}