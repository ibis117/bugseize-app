<?php

namespace App\Actions\Project;

use App\Models\Project;
use App\Traits\ShowAction;

class ShowProject
{
    use ShowAction;

    protected string $model = Project::class;
}
