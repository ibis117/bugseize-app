<?php

namespace App\Actions\Issue;

use App\Models\Issue;
use Ibis117\CrudActions\Traits\CreateAction;

class CreateIssue
{
    use CreateAction;

    protected string $model = Issue::class;

    public function rules(): array
    {
        return [
            //
        ];
    }
}
