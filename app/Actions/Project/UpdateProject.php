<?php

namespace App\Actions\Project;

use App\Models\Project;
use App\Traits\UpdateAction;

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
