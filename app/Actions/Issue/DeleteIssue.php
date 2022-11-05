<?php

namespace App\Actions\Issue;

use App\Models\Issue;
use Ibis117\CrudActions\Traits\DeleteAction;


class DeleteIssue
{
    use DeleteAction;

    protected string $model = Issue::class;
}
