<?php

namespace App\Actions\Permission;

use App\Models\Permission;
use Ibis117\CrudActions\Traits\DeleteAction;

#[\App\Attributes\Permission(permission: 'permission:delete')]
class DeletePermission
{
    use DeleteAction;

    protected string $model = Permission::class;
}
