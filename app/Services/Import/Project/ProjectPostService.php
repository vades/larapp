<?php

namespace App\Services\Import\Project;

use Exception;

class ProjectPostService
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
        throw new Exception('PostService not implemented');
        /* Log::info('Importing posts to the database');
        dd('Importing posts to the database');*/

    }
}
