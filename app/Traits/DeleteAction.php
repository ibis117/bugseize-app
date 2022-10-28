<?php

namespace App\Traits;

use App\Models\Project;
use Lorisleiva\Actions\Concerns\AsAction;

trait DeleteAction
{
    use AsAction;

    public function handle(Project $project, $deleteFromDatabase = false): bool
    {
        if ($deleteFromDatabase) {
            return $project->forceDelete();
        }

        return $project->delete();
    }

    public function asController(Project $project)
    {
        return response($this->handle($project), 204);
    }
}
