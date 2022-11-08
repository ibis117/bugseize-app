<?php

namespace App\Actions\Issue;

use App\Attributes\Permission;
use App\Models\Issue;
use Ibis117\CrudActions\Traits\ListAction;

#[Permission(permission: 'issue:list')]
class ListIssue
{
    use ListAction;

    protected string $model = Issue::class;

    protected array $ignoreFilter = [
        'page'
    ];

    protected function select()
    {
        return $this->model::select()->withCount(['exceptions']);
    }


    protected function filter($query, $filter)
    {
        foreach ($filter as $key => $value) {
            if (!in_array($key, $this->ignoreFilter)) {

            }
        }
        return $query;
    }


}
