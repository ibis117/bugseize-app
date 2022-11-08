<?php

namespace App\Actions\Role;

use App\Attributes\Permission;
use App\Models\Role;
use Ibis117\CrudActions\Traits\CreateAction;

#[Permission(permission: 'role:create')]
class CreateRole
{
    use CreateAction;

    protected string $model = Role::class;

    public function rules(): array
    {
        return [
            //
        ];
    }
}
