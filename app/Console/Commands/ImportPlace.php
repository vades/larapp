<?php

namespace App\Console\Commands;

use App\Services\Import\PostService;
use Illuminate\Console\Command;

class ImportPlace extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-place';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import places to the database';

    /**
     * Execute the console command.
     */
    public function handle(PostService $postService)
    {
        try {
            $postService->setPostType('place');
            $postService->handle();
            $this->info('Importing places');
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
