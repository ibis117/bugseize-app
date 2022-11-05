<?php

namespace App\Actions\BugException;

use App\Models\BugException;
use Ibis117\CrudActions\Traits\UpdateAction;

class MarkBugexceptionAsRead
{
    use UpdateAction;

    protected string $model = BugException::class;

    public function rules(): array
    {
        return [
            //
        ];
    }

    public function handle($id, array $data)
    {
        $model = $this->model::find($id);

        return tap($model)->update([
            'status' => 'read'
        ]);
    }


}
