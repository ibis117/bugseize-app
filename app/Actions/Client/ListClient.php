<?php

namespace App\Actions\Client;

use App\Models\Client;
use Ibis117\CrudActions\Traits\ListAction;


class ListClient
{
    use ListAction;

    protected string $model = Client::class;
}
