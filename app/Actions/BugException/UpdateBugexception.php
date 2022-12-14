<?php

namespace App\Actions\BugException;

use App\Attributes\Permission;
use App\Models\BugException;
use Ibis117\CrudActions\Traits\UpdateAction;

#[Permission(permission: 'bug-exception:update')]
class UpdateBugexception
{
    use UpdateAction;

    protected string $model = BugException::class;

    public function rules(): array
    {
        return [
            //
        ];
    }


}
