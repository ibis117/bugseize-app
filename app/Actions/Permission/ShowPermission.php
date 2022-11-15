<?php

namespace App\Actions\Permission;

use App\Models\Permission;
use Ibis117\CrudActions\Traits\ShowAction;

#[\App\Attributes\Permission(permission: 'permission:show')]
class ShowPermission
{
    use ShowAction;

    protected string $model = Permission::class;

    public function handle($id)
    {
        return $this->model::with('permissions')->first($id);
    }
}
