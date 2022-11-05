<?php

namespace App\Actions\BugException;

use App\Models\BugException;
use Ibis117\CrudActions\Traits\UpdateAction;

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
