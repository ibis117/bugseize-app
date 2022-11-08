<?php

namespace App\Actions\User;

use App\Attributes\Permission;
use App\Models\User;
use Ibis117\CrudActions\Traits\ShowAction;

#[Permission(permission: 'user:show')]
class ShowUser
{
    use ShowAction;

    protected string $model = User::class;


}
