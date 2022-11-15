<?php

namespace App\Actions\Role;

use App\Attributes\Permission;
use App\Models\Role;
use Ibis117\CrudActions\Traits\ShowAction;

#[Permission(permission: 'role:show')]
class ShowRole
{
    use ShowAction;

    protected string $model = Role::class;

    public function handle($id)
    {
        return $this->model::with(['permissions'])->findOrFail($id);
    }


}
