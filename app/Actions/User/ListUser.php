<?php

namespace App\Actions\User;

use App\Attributes\Permission;
use App\Models\User;
use Ibis117\CrudActions\Traits\ListAction;
use Lorisleiva\Actions\ActionRequest;
use ReflectionClass;

#[Permission(permission: 'user:list')]
class ListUser
{
    use ListAction;

    protected string $model = User::class;

    public function authorize(ActionRequest $request): bool
    {
        $class = new ReflectionClass($this);
        $arguments = $class->getAttributes(Permission::class);
        $permission = $arguments[0]->getArguments()['permission'];
//        dd($request->user()->hasPermissionTo('user:list'));
        return $request->user()->hasPermissionTo($permission);
    }

    protected function filter($query, $filter)
    {
        $query = $query->with(['roles','clients']);
        $user = auth()->user();
        if (!$user->hasRole('super-admin')) {
            $query->whereHas('clients',function($q) use ($user) {
                $q->where('user_id', $user->id);
            });
        }
        return $query;
    }

}
