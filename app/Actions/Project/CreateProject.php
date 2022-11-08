<?php

namespace App\Actions\Project;

use App\Attributes\Permission;
use App\Models\Project;
use Ibis117\CrudActions\Traits\CreateAction;

#[Permission(permission: 'project:create')]
class CreateProject
{
    use CreateAction;

    protected string $model = Project::class;

    public function rules(): array
    {
        return [
            'name' => 'required',
            'url' => 'required'
        ];
    }
}
