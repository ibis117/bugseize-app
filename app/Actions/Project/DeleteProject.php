<?php

namespace App\Actions\Project;

use App\Attributes\Permission;
use App\Models\Project;
use Ibis117\CrudActions\Traits\DeleteAction;

#[Permission(permission: 'project:delete')]
class DeleteProject
{
    use DeleteAction;

    protected string $model = Project::class;
}
