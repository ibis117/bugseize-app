<?php

namespace App\Actions\User;

use App\Attributes\Permission;
use App\Models\User;
use Ibis117\CrudActions\Traits\CreateAction;

#[Permission(permission: 'user:create')]
class CreateUser
{
    use CreateAction;

    protected string $model = User::class;

    public function rules(): array
    {
        return [
            //
        ];
    }
}
