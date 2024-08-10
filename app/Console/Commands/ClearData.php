<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class ClearData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear:data';
    protected $description = 'To Truncate Data';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->info('Starting migration fresh in Docker Compose environment...');

        // Define the service name and command to execute
        $serviceName = 'app'; // Replace 'app' with your actual service name
        $command = ['docker-compose', 'exec', '-T', $serviceName, 'php', 'artisan', 'migrate:fresh'];

        // Create a new process instance
        $process = new Process($command);

        // Run the process
        $process->run();

        // Check if the process was successful
        if (!$process->isSuccessful()) {
            // Output the error message
            $this->error('Migration failed: ' . $process->getErrorOutput());
            throw new ProcessFailedException($process);
        }

        // Output the success message
        $this->info('Migration fresh completed successfully.');
        $this->info($process->getOutput());
    }
}
