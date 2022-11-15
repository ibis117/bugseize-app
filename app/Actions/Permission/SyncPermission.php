<?php

namespace App\Actions\Permission;

use App\Attributes\Permission;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;
use ReflectionClass;

#[\App\Attributes\Permission(permission: 'permission:sync')]
class SyncPermission
{
    use AsAction;

    protected $allowed = [
        "App\Actions"
    ];

    protected $except = [
        "App\Actions\Log\CreateExceptionLog"
    ];

    public function handle()
    {
        $permissions = $this->permissions();
        foreach ($permissions as $permission) {
            [$group, $action] = explode(':', $permission);
            \App\Models\Permission::updateOrCreate([
                'name' => $permission,
                'group_name' => $group
            ]);
        }
    }

    protected function permissions()
    {
        $routes = Route::getRoutes();
        $permissions = [];
        foreach ($routes as $route) {
            if (is_string($route->action['uses'])) {
                $action = explode("@", $route->action['uses']);
                $class = $action[0];
                if (Str::startsWith($class, $this->allowed) && !in_array($class, $this->except)) {
                    $reflectionClass = new ReflectionClass($class);
                    $permissionAttribute = $reflectionClass->getAttributes(Permission::class);
                    foreach ($permissionAttribute as $attribute) {
                        $permissions[] = $attribute->getArguments()['permission'];
                    }
                }
            }
        }
        return $permissions;
    }

    public function asController(ActionRequest $request)
    {
        if (!$this->handle()) {
            return response([
                'message' => 'Unable to sync permission. Please try again'
            ], 400);
        }
        return response([
            'message' => 'Permission has been successfully synced'
        ], 200);
    }
}
