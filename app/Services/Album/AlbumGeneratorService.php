<?php

namespace App\Services\Album;

use Exception;
use Illuminate\Support\Str;
use Carbon\Carbon;

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

        $this->readAlbumDir($this->sourceDir);
        $this->readEventDir($this->sourceDir);

    }

    private function readAlbumDir(string $sourceDir): void
    {
        $directories = array_filter(glob($sourceDir . '/*'), 'is_dir');
        if (empty($directories)) {
            throw new Exception('No album directories found in: ' . $this->sourceDir);
        }

        $directories = array_map('basename', $directories);
        $this->albums = $this->parseDirectories($directories, $sourceDir);
        $filePath =  config('myapp.album.dir.target').'/'.config('myapp.album.file.album');
        //dd($filePath);
        $this->storeJsonFile( $this->albums , $filePath);
        //$this->parseAlbumDirectories($directories, $sourceDir, $this->albums);
    }
    private function readEventDir($sourceDir): void
    {
        foreach ($this->albums as $album) {
            $directories = array_filter(glob($sourceDir .'/'. $album['id'].'/*'), 'is_dir');

            if (empty($directories)) {
                throw new Exception('No album directories found in: ' . $this->sourceDir);
            }

            $directories = array_map('basename', $directories);

            $this->events = $this->parseDirectories($directories, $sourceDir.'/'.$album['id']);
            //dd($items);

            $filePath =  config('myapp.album.dir.target').'/'.config('myapp.album.file.event');
            //dd($filePath);
            //$this->storeJsonFile($this->events, $filePath);
           // dd($items);
            //$this->parseAlbumDirectories($directories,$sourceDir.'/'.$album['id'], $this->albums);
        }

    }

    private function parseDirectories(array $directories, string $sourceDir): array
    {
        $items = [];
        foreach ($directories as $directory) {
            $path = $sourceDir . '/' . $directory;
            $coverPath = $path . '/' . config('myapp.album.cover');
            $cover = null;
            if (!file_exists($coverPath)) {
                $this->errors[] = 'WARNING: No cover found in directory: ' . $path;
                continue;
            }

            if (file_exists($coverPath) && @getimagesize($coverPath,$imageData)) {
                $cover = $this->url . '/' . $directory . '/'.config('myapp.album.cover');
                $iptc = $this->getIptcData($imageData);
            }else{
                $this->errors[] = 'WARNING: Invalid cover image found in directory: ' . $path;
                continue;
            }
            //$this->buildJsonFile($directory, $cover, $iptc);
            $items[] = $this->parseAlbumItem($directory, $cover, $iptc);


        }
        return $items;
    }

    private function parseAlbumDirectories(array $directories, string $sourceDir, array $items): void
    {
        foreach ($directories as $directory) {
            $path = $sourceDir . '/' . $directory;
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
            //$this->buildJsonFile($directory, $cover, $iptc);
            $this->albums[] = $this->parseAlbumItem($directory, $cover, $iptc);


        }
        $filePath =  config('myapp.album.dir.target').'/'.config('myapp.album.file.album');
        $this->storeJsonFile($items, $filePath);
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

    private function parseAlbumItem(string $directory, string $src, array $iptc): array
    {
        return [
            'id' =>$directory,
            'src' =>$src,
            'title' => $iptc['title'] ?? $directory,
            'createdAt' => new Carbon($iptc['date'] ?? null),
            'description' =>$iptc['description'] ?? null,
        ];


    }

    private function storeJsonFile($array, $filePath): void
    {
        if (count($array) > 0) {
            $json = json_encode($this->albums, JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES);
            if ($json === false) {
                $this->errors[] = 'ERROR: Failed to generate JSON from albums array.';
                return;
            }


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
