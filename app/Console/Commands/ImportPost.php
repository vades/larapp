<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Services\Import\PostService;
class ImportPost extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-post';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import posts to the database';

    /**
     * Execute the console command.
     */
    public function handle(PostService $postService)
    {
        try {
            $postService->handle();
            $this->info('Some info');
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }

    }
}
