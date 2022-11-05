<?php

namespace App\Actions\Project;

use App\Models\Project;
use Ibis117\CrudActions\Traits\CreateAction;

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
