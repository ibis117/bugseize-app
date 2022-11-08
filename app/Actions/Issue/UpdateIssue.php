<?php

namespace App\Actions\Issue;

use App\Attributes\Permission;
use App\Models\Issue;
use Ibis117\CrudActions\Traits\UpdateAction;

#[Permission(permission: 'issue:update')]
class UpdateIssue
{
    use UpdateAction;

    protected string $model = Issue::class;

    public function rules(): array
    {
        return [
            //
        ];
    }


}
