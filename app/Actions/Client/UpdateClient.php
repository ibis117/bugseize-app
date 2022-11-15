<?php

namespace App\Actions\Client;

use App\Models\Client;
use Ibis117\CrudActions\Traits\UpdateAction;

class UpdateClient
{
    use UpdateAction;

    protected string $model = Client::class;

    public function rules(): array
    {
        return [
            //
        ];
    }


}
