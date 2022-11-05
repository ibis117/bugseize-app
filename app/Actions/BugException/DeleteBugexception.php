<?php

namespace App\Actions\BugException;

use App\Models\BugException;
use Ibis117\CrudActions\Traits\DeleteAction;


class DeleteBugexception
{
    use DeleteAction;

    protected string $model = BugException::class;
}
