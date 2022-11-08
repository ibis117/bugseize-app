<?php

namespace App\Actions\BugException;

use App\Attributes\Permission;
use App\Models\BugException;
use Ibis117\CrudActions\Traits\DeleteAction;

#[Permission(permission: 'bug-exception:delete')]
class DeleteBugexception
{
    use DeleteAction;

    protected string $model = BugException::class;
}
