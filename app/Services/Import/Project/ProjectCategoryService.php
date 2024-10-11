<?php

namespace App\Services\Import\Project;

use Exception;

class ProjectCategoryService
{
   private array $files = [];

    private array $errors = [];

    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * @throws Exception
     */
    public function handle(): void
    {
        throw new Exception('CategoryService not implemented');
        /* Log::info('Importing categories to the database');
        dd('Importing categories to the database');*/
    }
}
