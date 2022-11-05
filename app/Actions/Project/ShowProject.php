<?php

namespace App\Actions\Project;

use App\Models\Project;
use Ibis117\CrudActions\Traits\ShowAction;

class ShowProject
{
    use ShowAction;

    protected string $model = Project::class;

    public function handle($id)
    {
        return $this->model::withCount(['exception', 'readException'])->findOrFail($id);
    }

}
