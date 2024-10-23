<?php

namespace App\Services\Import\Project;

use Exception;
use Illuminate\Support\Facades\Log;

class ProjectService
{
    private string $project;

    private array $errors = [];

    private array $success = [];
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
            $categoryService = new ProjectCategoryService($this->project);
            $categoryService->handle();
           array_push($this->errors, $categoryService->getErrors());

            $postService = new ProjectPostService($this->project);
            $postService->handle();
            array_push($this->errors, $postService->getErrors());


            //dd('Importing DEV project data to the database');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }


    }

    private function importIvnbgProject(): void
    {
        throw new Exception('ImportProject not implemented for project: ' . $this->project);


    }
}
