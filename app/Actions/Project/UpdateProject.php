<?php

namespace App\Actions\Project;

use App\Models\Project;
use Ibis117\CrudActions\Traits\UpdateAction;

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
