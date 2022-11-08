<?php

namespace App\Actions\User;

use App\Attributes\Permission;
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


}
