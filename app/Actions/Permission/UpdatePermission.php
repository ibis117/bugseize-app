<?php

namespace App\Actions\Permission;

use App\Models\Permission;
use Ibis117\CrudActions\Traits\UpdateAction;

#[\App\Attributes\Permission(permission: 'permission:update')]
class UpdatePermission
{
    use UpdateAction;

    protected string $model = Permission::class;

    public function rules(): array
    {
        return [
            //
        ];
    }


}
