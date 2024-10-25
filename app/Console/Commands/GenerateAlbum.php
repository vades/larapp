<?php

namespace App\Console\Commands;

use App\Services\Album\AlbumGeneratorService;
use Exception;
use Illuminate\Console\Command;

class GenerateAlbum extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-album';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate album';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $service = new AlbumGeneratorService();
            $service->handle();

        }catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
