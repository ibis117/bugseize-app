<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class Deploy extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:deploy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->start([
            'php artisan -V',
            'composer install',
            'php artisan migrate',
            'npm install',
            'npm run build',
            'php artisan optimize:clear',
            'php artisan optimize'
        ]);
        return Command::SUCCESS;
    }

    protected function start($commands)
    {

        foreach ($commands as $command) {
            $process = Process::fromShellCommandline($command);
            $process->run();
            echo $process->getOutput();
        }
    }
}
