<?php

namespace App\Actions\Client;

use App\Attributes\Permission;
use App\Models\Client;
use Ibis117\CrudActions\Traits\ListAction;

#[Permission(permission: 'client:list')]
class ListClient
{
    use ListAction;

    protected string $model = Client::class;


    protected function filter($query, $filter)
    {
        $user = auth()->user();
        if (!$user->hasRole('super-admin')) {
            $client = $user->clients()->first();
            $query->where('id', $client->id);
        }
        return $query;
    }

}
