<?php

namespace App\Actions\Issue;

use App\Attributes\Permission;
use App\Models\Issue;
use Ibis117\CrudActions\Traits\ShowAction;

#[Permission(permission: 'issue:show')]
class ShowIssue
{
    use ShowAction;

    protected string $model = Issue::class;


}
