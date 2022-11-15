<?php

namespace App\Actions\Permission;

use App\Models\Permission;
use Lorisleiva\Actions\Concerns\AsAction;

class ExceptPermission
{
    use AsAction;

    public function handle(array $list)
    {
        $query = Permission::query();
        foreach ($list as $value) {
            $query->where('group_name', '!=', $value);
        }
        return $query->get();
    }
}
