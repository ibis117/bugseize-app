<?php

namespace App\Actions\Client;

use App\Attributes\Permission;
use App\Models\Client;
use Ibis117\CrudActions\Traits\DeleteAction;

#[Permission(permission: 'client:delete')]
class DeleteClient
{
    use DeleteAction;

    protected string $model = Client::class;
}
