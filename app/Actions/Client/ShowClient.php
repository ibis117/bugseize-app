<?php

namespace App\Actions\Client;

use App\Models\Client;
use Ibis117\CrudActions\Traits\ShowAction;

class ShowClient
{
    use ShowAction;

    protected string $model = Client::class;


}
