<?php

namespace App\Actions\BugException;

use App\Attributes\Permission;
use App\Models\BugException;
use Ibis117\CrudActions\Traits\ShowAction;

#[Permission(permission: 'bug-exception:show')]
class ShowBugexception
{
    use ShowAction;

    protected string $model = BugException::class;

}
