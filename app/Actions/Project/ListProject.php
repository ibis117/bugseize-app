<?php

namespace App\Actions\Project;

use App\Models\Project;
use App\Traits\ListAction;

class ListProject
{
    use ListAction;

    protected string $model = Project::class;
}
