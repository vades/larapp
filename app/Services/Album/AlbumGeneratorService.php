<?php

namespace App\Services\Album;

use Exception;
use Illuminate\Support\Str;

class AlbumGeneratorService
{
    private string $sourceDir;
    private string $targetDir;

    private string $url;

    private array $albums = [];
    private array $events = [];
    private array $images = [];

    private array $errors = [];

    public function getErrors(): array
    {
        return $this->errors;
    }

    private array $success = [];

    public function getSuccess(): array
    {
        return $this->success;
    }


    public function __construct()
    {
        $this->sourceDir = config('myapp.album.dir.source');
        $this->targetDir = config('myapp.album.dir.target');
        $this->url = config('myapp.album.url');

    }

    public function handle(): void
    {

        $this->readAlbumDir();

    }

    private function readAlbumDir(): void
    {
        $directories = array_filter(glob($this->sourceDir . '/*'), 'is_dir');
        if (empty($directories)) {
            throw new Exception('No album directories found in: ' . $this->sourceDir);
        }

        $directories = array_map('basename', $directories);
        $this->parseAlbumDirectories($directories);
    }

    private function parseAlbumDirectories(array $directories): void
    {
        foreach ($directories as $directory) {
            $path = $this->sourceDir . '/' . $directory;
            $coverPath = $path . '/' . config('myapp.album.cover');
            $cover = null;
            if (!file_exists($coverPath)) {
                $this->errors[] = 'WARNING: No cover found in directory: ' . $path;
                continue;
            }

            if (file_exists($coverPath) && @getimagesize($coverPath,$imageData)) {
               $cover = $this->url . '/' . $directory . '/'.config('myapp.album.cover');
               $iptc = $this->getIptcData($imageData);
              // $xif = $this->readExifData($coverPath);
               //dd($xif);
            }else{
                $this->errors[] = 'WARNING: Invalid cover image found in directory: ' . $path;
                continue;
            }
            $this->buildJsonFile($directory, $cover, $iptc);


        }
        $this->storeJsonFile();
    }

    private function getIptcData($imageData)
    {
        $return = array('title' => null, 'description' => null, 'author' => null, 'tags' => null);
        if(isset($imageData['APP13'])) {
            $iptc = iptcparse($imageData['APP13']);
            $return['title'] = $iptc['2#005'][0] ?? null;
            $return['description'] = $iptc['2#120'][0] ?? null;
            $return['author'] = $iptc['2#080'][0] ?? null;
            $return['tags'] = $iptc['2#025'] ?? null;
            $return['date'] = $iptc['2#062'][0] ?? null;
        }
        return $return;
    }

    private function readExifData(string $coverPath): array
    {
        $exifData = @exif_read_data($coverPath, 'ANY_TAG', true);
        // Additionnal informations from Lightroom
        getimagesize( $coverPath, $infos);
        dd(iptcparse($infos['APP13']));
        if ( isset($infos['APP13']) ) {
            print_r(iptcparse($infos['APP13']));
        }
        return $exifData;
        if ($exifData === false) {
            $this->errors[] = 'ERROR: Failed to read EXIF data from image: ' . $coverPath;
            return ['title' => null, 'description' => null];
        }

        $title = $exifData['ImageDescription'] ?? null;
        $description = $exifData['UserComment'] ?? null;

        return ['title' => $title, 'description' => $description];
    }

    private function buildJsonFile(string $directory, string $src, array $iptc): void
    {
        $array = [
               'id' =>$directory.'_'.Str::uuid(),
               'src' =>$src,
               'title' => $iptc['title'] ?? $directory,
               'createdAt' => $iptc['date'] ?? null,
               'description' =>$iptc['description'] ?? null,
        ];
        $this->albums[] = $array;

    }

    private function storeJsonFile(): void
    {
        if (count($this->albums) > 0) {
            $json = json_encode($this->albums, JSON_PRETTY_PRINT);
            if ($json === false) {
                $this->errors[] = 'ERROR: Failed to generate JSON from albums array.';
                return;
            }

            $filePath =  config('myapp.album.dir.target').'/'.config('myapp.album.file.album');
            if (file_put_contents($filePath, $json) === false) {
                $this->errors[] = 'ERROR: Failed to save JSON to file: ' . $filePath;
            } else {
                $this->success[] = 'SUCCESS: JSON file saved successfully: ' . $filePath;
            }
        } else {
            $this->errors[] = 'WARNING: No albums to save.';
        }
    }

    private function createJson(): void
    {
        throw new Exception('Not implemented');
    }
}
