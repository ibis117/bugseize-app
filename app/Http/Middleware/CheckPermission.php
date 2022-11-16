<?php

namespace App\Http\Middleware;

use App\Attributes\Permission;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use ReflectionClass;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
        $actionClass = Route::current()->action['controller'];
        $class = new ReflectionClass($actionClass);
        $arguments = $class->getAttributes(Permission::class);
        if (!empty($arguments)) {
            $permission = $arguments[0]->getArguments()['permission'];
            abort_if(!$request->user()->hasPermissionTo($permission), 403);
        }
        return $next($request);
    }
}
