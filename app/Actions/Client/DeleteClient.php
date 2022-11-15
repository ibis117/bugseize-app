<?php

namespace App\Actions\Client;

use App\Models\Client;
use Ibis117\CrudActions\Traits\DeleteAction;


class DeleteClient
{
    use DeleteAction;

    protected string $model = Client::class;
}
