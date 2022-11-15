<?php

namespace App\Actions\Permission;

use App\Models\Permission;
use Ibis117\CrudActions\Traits\ListAction;

#[\App\Attributes\Permission(permission: 'permission:list')]
class ListPermission
{
    use ListAction;

    protected string $model = Permission::class;

    protected function paginate($query, $count)
    {
        return $query->get();
    }
}
