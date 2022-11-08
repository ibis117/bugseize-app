<?php

namespace App\Actions\Role;

use App\Attributes\Permission;
use App\Models\Role;
use Ibis117\CrudActions\Traits\UpdateAction;

#[Permission(permission: 'role:update')]
class UpdateRole
{
    use UpdateAction;

    protected string $model = Role::class;

    public function rules(): array
    {
        return [
            //
        ];
    }


}
