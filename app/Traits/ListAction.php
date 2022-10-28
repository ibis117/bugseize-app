<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

trait ListAction
{
    use AsAction;

    public function handle($count = 10)
    {
        $query = $this->model::select();
        $query = $this->filter($query);

        return $query->paginate($count);
    }

    public function filter($query)
    {
        return $query;
    }

    public function asController(Request $request)
    {
        $count = $request['count'] ?? 10;
        $projects = $this->handle($count);
        $result = [
            'perPage' => $projects->perPage(),
            'currentPage' => $projects->currentPage(),
            'lastPage' => $projects->lastPage(),
            'data' => $projects->items(),
        ];

        return response($result, 200);
    }
}
