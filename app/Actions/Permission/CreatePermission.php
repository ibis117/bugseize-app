<?php

namespace App\Actions\Permission;

use App\Models\Permission;
use Ibis117\CrudActions\Traits\CreateAction;

#[\App\Attributes\Permission(permission: 'permission:create')]
class CreatePermission
{
    use CreateAction;

    protected string $model = Permission::class;

    public function rules(): array
    {
        return [

        ];
    }
}
