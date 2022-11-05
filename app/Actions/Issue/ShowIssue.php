<?php

namespace App\Actions\Issue;

use App\Models\Issue;
use Ibis117\CrudActions\Traits\ShowAction;

class ShowIssue
{
    use ShowAction;

    protected string $model = Issue::class;


}
