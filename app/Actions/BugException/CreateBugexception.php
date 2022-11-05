<?php

namespace App\Actions\BugException;

use App\Models\BugException;
use Ibis117\CrudActions\Traits\CreateAction;

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
