<?php

namespace App\Actions\BugException;

use App\Models\BugException;
use Ibis117\CrudActions\Traits\ListAction;


class ListBugexception
{
    use ListAction;

    protected string $model = BugException::class;

    protected function paginate($query, $count)
    {
        return $query->orderBy('created_at', 'desc')
            ->paginate($count);
    }


}
