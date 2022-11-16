<?php

namespace App\Actions\Role;

use App\Attributes\Permission;
use App\Models\Role;
use Ibis117\CrudActions\Traits\ListAction;

#[Permission(permission: 'role:list')]
class ListRole
{
    use ListAction;

    protected string $model = Role::class;

    protected function filter($query, $filter)
    {
        $user = auth()->user();
        if (!$user->hasRole('super-admin')) {
            $query->where('name', '!=', 'super-admin');
        }
        return $query->with(['permissions']);
    }

}
