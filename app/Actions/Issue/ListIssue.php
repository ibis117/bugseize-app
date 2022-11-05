<?php

namespace App\Actions\Issue;

use App\Models\Issue;
use Ibis117\CrudActions\Traits\ListAction;


class ListIssue
{
    use ListAction;

    protected string $model = Issue::class;
}
