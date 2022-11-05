<?php

namespace App\Actions\BugException;

use App\Models\BugException;
use Ibis117\CrudActions\Traits\ShowAction;

class ShowBugexception
{
    use ShowAction;

    protected string $model = BugException::class;

}
