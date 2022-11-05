<?php

namespace App\Actions\Project;

use App\Models\Project;
use Ibis117\CrudActions\Traits\DeleteAction;


class DeleteProject
{
    use DeleteAction;

    protected string $model = Project::class;
}
