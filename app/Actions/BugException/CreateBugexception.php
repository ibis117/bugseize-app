<?php

namespace App\Actions\BugException;

use App\Attributes\Permission;
use App\Models\BugException;
use Ibis117\CrudActions\Traits\CreateAction;

#[Permission(permission: 'bug-exception:create')]
class CreateBugexception
{
    use CreateAction;

    protected string $model = BugException::class;

    public function rules(): array
    {
        return [
            //
        ];
    }
}
