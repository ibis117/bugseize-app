<?php

namespace App\Actions\Issue;

use App\Attributes\Permission;
use App\Models\Issue;
use Ibis117\CrudActions\Traits\DeleteAction;

#[Permission(permission: 'issue:delete')]
class DeleteIssue
{
    use DeleteAction;

    protected string $model = Issue::class;
}
