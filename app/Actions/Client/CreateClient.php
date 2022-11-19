<?php

namespace App\Actions\Client;

use App\Attributes\Permission;
use App\Models\Client;
use Ibis117\CrudActions\Traits\CreateAction;

#[Permission(permission: 'client:create')]
class CreateClient
{
    use CreateAction;

    protected string $model = Client::class;

    public function rules(): array
    {
        return [
            //
        ];
    }
}
