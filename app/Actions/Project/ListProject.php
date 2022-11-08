<?php

namespace App\Actions\Project;

use App\Attributes\Permission;
use App\Models\Project;
use Ibis117\CrudActions\Traits\ListAction;

#[Permission(permission: 'project:list')]
class ListProject
{
    use ListAction;

    protected string $model = Project::class;

    protected function paginate($query, $count)
    {
        return $query->withCount(['exception', 'readException', 'issue'])
            ->paginate($count);
    }

    protected function filter($query, $filter)
    {
        $query->when(@$filter['search'], fn($q) => $q->where('name', 'like', "%{$filter['search']}%"));
        return $query;
    }

}
