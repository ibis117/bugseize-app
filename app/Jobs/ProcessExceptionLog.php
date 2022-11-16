<?php

namespace App\Jobs;

use App\Broadcasting\RecentExceptionChannel;
use App\Models\BugException;
use App\Models\ExceptionLog;
use App\Models\Issue;
use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessExceptionLog implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private ExceptionLog $log;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(ExceptionLog $log)
    {
        $this->log = $log;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $exception_log = $this->log;

        $log = $exception_log->log;
        $project_id = $exception_log->project_id;
        $client_id = $exception_log->client_id;
        $errors = $log['error'];
        $executor = $log['executor'];
        $storage = $log['storage'];
        $class = $log['class'];
        $file = $log['file'];
        $line = $log['line'];
        $exception = $log['exception'];
        $fullUrl = $log['fullUrl'];
        $method = $log['method'];
        $host = $log['host'];
        $environment = $log['environment'];
        $user = $log['user'];

        $issue = Issue::updateOrCreate([
            'exception' => $exception,
            'line' => $line,
            'project_id' => $project_id,
            'client_id' => $client_id
        ], [
            'last_occurred_at' => now()
        ]);

        $bug_exception = BugException::create([
            'host' => $host,
            'method' => $method,
            'full_url' => $fullUrl,
            'executor' => $executor,
            'exception' => $exception,
            'environment' => $environment,
            'errors' => $errors,
            'line' => $line,
            'storage' => $storage,
            'file' => $file,
            'user' => $user,
            'project_id' => $project_id,
            'issue_id' => $issue->id,
            'status' => 'unread',
            'client_id' => $client_id
        ]);

        if (!$issue->bug_exception_id) {
            $issue->bug_exception_id = $bug_exception->id;
            $issue->save();
        }

        $exception_log->is_processed = true;
        $exception_log->save();
        $user = Project::find($exception_log->project_id)->user()->first();
        RecentExceptionChannel::dispatch($user->id);
    }
}
