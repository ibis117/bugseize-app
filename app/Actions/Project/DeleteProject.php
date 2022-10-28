<?php

namespace App\Actions\Project;

use App\Models\Project;
use App\Traits\DeleteAction;

class DeleteProject
{
    use DeleteAction;

    protected string $model = Project::class;
}
