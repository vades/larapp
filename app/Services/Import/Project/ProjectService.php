<?php

namespace App\Services\Import\Project;

use Exception;
use Illuminate\Support\Facades\Log;

class ProjectService
{
    private string $project;
    /**
     * Create a new class instance.
     */
    public function __construct(string $project)
    {
        $this->project = $project;
    }

    /**
     * @throws Exception
     */
    public function handle(): void
    {

        match ($this->project) {
            'dev' => $this->importDevProject(),
            'ivnbg' => $this->importIvnbgProject(),
            default =>  throw new Exception('Unknown project: ' . $this->project),
        };

    }

    private function importDevProject(): void
    {

        try {
            Log::info('Importing DEV project data to the database');
            dd('Importing DEV project data to the database');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

    }

    private function importIvnbgProject(): void
    {
        throw new Exception('ImportProject not implemented for project: ' . $this->project);


    }
}
