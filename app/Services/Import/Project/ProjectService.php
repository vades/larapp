<?php

namespace App\Services\Import\Project;

use Exception;

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
            default =>  throw new Exception('Unknown project: ' . $this->project),
        };

    }

    private function importDevProject(): void
    {
        throw new Exception('ImportProject not implemented for project: ' . $this->project);
    }
}
