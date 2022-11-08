<?php

namespace App\Actions\Role;

use App\Attributes\Permission;
use App\Models\Role;
use Ibis117\CrudActions\Traits\DeleteAction;

#[Permission(permission: 'role:delete')]
class DeleteRole
{
    use DeleteAction;

    protected string $model = Role::class;
}
