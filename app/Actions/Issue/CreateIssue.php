<?php

namespace App\Actions\Issue;

use App\Attributes\Permission;
use App\Models\Issue;
use Ibis117\CrudActions\Traits\CreateAction;

#[Permission(permission: 'issue:create')]
class CreateIssue
{
    use CreateAction;

    protected string $model = Issue::class;

    public function rules(): array
    {
        return [
            //
        ];
    }
}
