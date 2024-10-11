<?php

namespace App\Console\Commands;

use App\Services\Import\Project\ProjectService;
use Illuminate\Console\Command;

class ImportProject extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-project {--name=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import DEV project data to the database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $project = $this->option('name');
        if(empty($project)) {
            $this->error('Project name is required. Please provide a project name using --name option');
            return;
        }

        $this->info('Importing data for project: ' . $project);

        try {
            $service = new ProjectService($project);
            $service->handle();
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }

    }
}