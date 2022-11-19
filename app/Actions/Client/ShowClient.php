<?php

namespace App\Actions\Client;

use App\Attributes\Permission;
use App\Models\Client;
use Ibis117\CrudActions\Traits\ShowAction;
#[Permission(permission: 'client:show')]
class ShowClient
{
    use ShowAction;

    protected string $model = Client::class;


}
