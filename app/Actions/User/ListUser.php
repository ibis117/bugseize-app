<?php

namespace App\Actions\User;

use App\Attributes\Permission;
use App\Models\User;
use Ibis117\CrudActions\Traits\ListAction;

#[Permission(permission: 'user:list')]
class ListUser
{
    use ListAction;

    protected string $model = User::class;
}
