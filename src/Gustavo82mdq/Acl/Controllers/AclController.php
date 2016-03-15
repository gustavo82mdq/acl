<?php

namespace App\Http\Controllers;

use Bican\Roles\Models\Permission;
use Bican\Roles\Models\Role;
use Illuminate\Http\Request;
use Route;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AclController extends Controller
{
    public function __construct() {
        //$this->middleware('role:admin');
    }

    public function index() {
        $roles = Role::all();

        $controllers = [];
        foreach (Route::getRoutes()->getRoutes() as $route) {
            $action = $route->getAction();

            if (array_key_exists('controller', $action))
            {
                // You can also use explode('@', $action['controller']); here
                // to separate the class name from the method
                $controllers[] = str_replace('Controller', '', str_replace('@', '.', studly_case(class_basename($action['controller']))));
            }
        }

        return view('acl.index', ['roles' => $roles, 'actions' => $controllers]);
    }

    public function setPermission(Request $request, $action, $role_id)
    {
        $permission = Permission::where('slug', $action)->first();
        $role = Role::find($role_id);

        if (empty($permission)) {
            $permission = Permission::create([
                'name' => studly_case($action),
                'slug' => $action
            ]);

        }

        $role->attachPermission($permission);

        if ($request->ajax()) {
            return view('acl.parts.aclbuttons', ['action' => $action, 'role' => $role]);
        } else {
            $method = new \ReflectionMethod('App\Http\Controllers\AclController', 'index');
            return $method->invoke($this);
        }
    }

    public function unsetPermission(Request $request, $action, $role_id) {
        $permission = Permission::where('slug', $action)->first();
        $role = Role::find($role_id);

        if (!empty($permission)) {
            $role->detachPermission($permission);
        }

        if ($request->ajax()) {
            return view('acl.parts.aclbuttons', ['action' => $action, 'role' => $role]);
        } else {
            $method = new \ReflectionMethod('App\Http\Controllers\AclController', 'index');
            return $method->invoke($this);
        }
    }

    public function setAll(Request $request, $role_id) {

        $role = Role::find($role_id);
        foreach (Route::getRoutes()->getRoutes() as $route) {
            $action = $route->getAction();

            if (array_key_exists('controller', $action))
            {
                $permission_name = str_replace('Controller', '', str_replace('@', '.', studly_case(class_basename($action['controller']))));
                $permission = Permission::where('slug', $permission_name)->first();

                if (empty($permission)) {
                    $permission = Permission::create([
                        'name' => studly_case($permission_name),
                        'slug' => $permission_name
                    ]);

                }

                $role->attachPermission($permission);
            }
        }

        $method = new \ReflectionMethod('App\Http\Controllers\AclController', 'index');
        return $method->invoke($this);
    }

    public function unsetAll(Request $request, $role_id) {
        $role = Role::find($role_id);
        $role->detachAllPermissions();
        $method = new \ReflectionMethod('App\Http\Controllers\AclController', 'index');
        return $method->invoke($this);
    }
}
