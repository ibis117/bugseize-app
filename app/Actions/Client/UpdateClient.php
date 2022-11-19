<?php

namespace App\Actions\Client;

use App\Attributes\Permission;
use App\Models\Client;
use Ibis117\CrudActions\Traits\UpdateAction;

#[Permission(permission: 'client:update')]
class UpdateClient
{
    use UpdateAction;

    protected string $model = Client::class;

    public function rules(): array
    {
        return [
            //
        ];
    }


}
