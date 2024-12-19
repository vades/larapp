<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CsvToMd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:csv-to-md';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Running csv-to-md');
        $this->process();
    }

    public function process(): void
    {
        $csvFile = storage_path('app/imports/ivnbg-places.csv');
        $outputDir = storage_path('app/imports/projects/ivnbg/posts/place');

        if (!file_exists($outputDir)) {
            mkdir($outputDir, 0777, true);
        }

        if (($handle = fopen($csvFile, 'r')) !== false) {
            $headers = fgetcsv($handle, 1000, ',');
            $index = 1;

            while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                $content = [];
                foreach ($headers as $key => $header) {
                    $content[$header] = $data[$key];
                }

                $slug = $content['slug'];
                if(empty($slug)) {
                    continue;
                }
                $filename = sprintf('%04d-%s.md', $index, $slug);
                $filePath = $outputDir . '/' . $filename;

                $mdContent = "---\n";
                foreach ($content as $key => $value) {
                    if($key === 'content') {
                        continue;
                    }
                    if($key === 'is_featured') {
                        $value = 0;
                    }
                    if (is_string($value)) {
                        $value = '"' . $value . '"';
                    }
                    $mdContent .= "$key: $value\n";
                }
                $mdContent .= "---\n\n";
                $mdContent .= $content['content'] ?? '';

                file_put_contents($filePath, $mdContent);
                $index++;
            }

            fclose($handle);
        }
    }
}
