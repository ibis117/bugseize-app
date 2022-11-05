<?php

namespace App\Actions\Issue;

use App\Models\Issue;
use Ibis117\CrudActions\Traits\UpdateAction;

class UpdateIssue
{
    use UpdateAction;

    protected string $model = Issue::class;

    public function rules(): array
    {
        return [
            //
        ];
    }


}
