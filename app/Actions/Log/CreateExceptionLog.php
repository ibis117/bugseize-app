<?php

namespace App\Actions\Log;

use App\Jobs\ProcessExceptionLog;
use App\Models\ExceptionLog;
use App\Models\Project;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateExceptionLog
{
    use AsAction;

    public function handle($data, $project_id)
    {
        $exceptionLog = ExceptionLog::create([
            'log' => $data,
            'project_id' => $project_id
        ]);

        ProcessExceptionLog::dispatch($exceptionLog);
        return $exceptionLog;
    }

    public function asController(Request $request)
    {
        $project = Project::where('key', $request->header('X-BugSeize-Key'))
            ->first();
        if ($project) {
            $result = $this->handle($request->all(), $project->id);
            if ($result) {
                return response(['message' => 'Recorded Successfully'], 200);
            }
            return response(['message' => 'Bad Request'], 400);
        }

        return response(['message' => 'Unauthenticated'], 401);
    }
}
