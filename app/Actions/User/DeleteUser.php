<?php

namespace App\Actions\User;

use App\Attributes\Permission;
use App\Models\User;
use Ibis117\CrudActions\Traits\DeleteAction;

#[Permission(permission: 'user:delete')]
class DeleteUser
{
    use DeleteAction;

    protected string $model = User::class;
}
