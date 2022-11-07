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

    protected function filter($query, $filter)
    {
        $query->when(@$filter['project_id'], fn($q) => $q->where('project_id', $filter['project_id']));
        return $query;
    }


}
