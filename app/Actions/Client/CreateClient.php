<?php

namespace App\Actions\Client;

use App\Models\Client;
use Ibis117\CrudActions\Traits\CreateAction;

class CreateClient
{
    use CreateAction;

    protected string $model = Client::class;

    public function rules(): array
    {
        return [
            //
        ];
    }
}
