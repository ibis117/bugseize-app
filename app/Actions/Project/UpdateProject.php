<?php

namespace App\Actions\Project;

use App\Attributes\Permission;
use App\Models\Project;
use Ibis117\CrudActions\Traits\UpdateAction;

#[Permission(permission: 'project:update')]
class UpdateProject
{
    use UpdateAction;

    protected string $model = Project::class;

    public function rules(): array
    {
        return [
            //
        ];
    }


}
