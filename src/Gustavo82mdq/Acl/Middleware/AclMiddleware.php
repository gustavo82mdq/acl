<?php

namespace Gustavo82mdq\Acl\Middleware;

use Bican\Roles\Exceptions\PermissionDeniedException;
use Closure;
use Illuminate\Support\Facades\Auth;
use Route;
use Illuminate\Support\Str;

class AclMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $action = Route::getCurrentRoute()->getAction();
        if (array_key_exists('controller', $action)) {
            $permission = str_replace('Controller', '', str_replace('@', '.', studly_case(class_basename($action['controller']))));
        }

        if (Auth::check() && Auth::user()->can(Str::slug($permission, config('roles.separator')))) {
            return $next($request);
        }

        throw new PermissionDeniedException($permission);
    }
}
