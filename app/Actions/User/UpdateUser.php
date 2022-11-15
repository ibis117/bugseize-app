<?php

namespace App\Actions\User;

use App\Attributes\Permission;
use App\Models\Role;
use App\Models\User;
use Ibis117\CrudActions\Traits\UpdateAction;

#[Permission(permission: 'user:update')]
class UpdateUser
{
    use UpdateAction;

    protected string $model = User::class;

    public function rules(): array
    {
        return [
            //
        ];
    }

    public function handle($id, array $data)
    {
        $model = $this->model::find($id);
        $model->update($data);
        $role = Role::find($data['role_id']);
        $model->assignRole($role);
        $model->clients()->sync($data['client_id']);
        return $model;
    }


}
