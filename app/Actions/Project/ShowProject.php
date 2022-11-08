<?php

namespace App\Actions\Project;

use App\Attributes\Permission;
use App\Models\Project;
use Ibis117\CrudActions\Traits\ShowAction;

#[Permission(permission: 'project:show')]
class ShowProject
{
    use ShowAction;

    protected string $model = Project::class;

    public function handle($id)
    {
        return $this->model::withCount(['exception', 'readException'])->findOrFail($id);
    }

}
