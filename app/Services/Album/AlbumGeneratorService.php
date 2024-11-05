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
        $this->readImageDir($this->sourceDir);

    }

    private function readAlbumDir(string $sourceDir): void
    {
        $directories = array_filter(glob($sourceDir . '/*'), 'is_dir');
        if (empty($directories)) {
            throw new Exception('No album directories found in: ' . $this->sourceDir);
        }

        $directories = array_map('basename', $directories);
        $this->albums = $this->parseCoverDirectories($directories, $sourceDir);
        $filePath =  config('myapp.album.dir.target').'/'.config('myapp.album.file.album');

        $this->storeJsonFile( $this->albums , $filePath);
    }
    private function readEventDir($sourceDir): void
    {
        $events = [];
        foreach ($this->albums as $album) {
            $directories = array_filter(glob($sourceDir .'/'. $album['id'].'/*'), 'is_dir');

            if (empty($directories)) {
                throw new Exception('No event directories found in: ' . $this->sourceDir);
            }

            $directories = array_map('basename', $directories);

            $events[] = $this->parseCoverDirectories($directories, $sourceDir.'/'.$album['id'], $album['id']);
        }
        $this->events = array_merge(...$events);;
        $targetFilePath =  config('myapp.album.dir.target').'/'.config('myapp.album.file.event');

        $this->storeJsonFile($this->events, $targetFilePath);

    }

    private function parseCoverDirectories(array $directories, string $sourceDir, ?string $parentDir = null): array
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
            $items[] = $this->parseAlbumCover($directory, $cover, $iptc, $parentDir);


        }
        return $items;
    }
    private function parseAlbumCover(string $directory, string $src, array $iptc, ?string $parentDir = null): array
    {
        return [
            'id' =>($parentDir ? $parentDir .'/':'') .$directory,
            'parentId' => $parentDir ?? null,
            'src' =>$src,
            'title' => $iptc['title'] ?? $directory,
            'createdAt' => new Carbon($iptc['date'] ?? null),
            'description' =>$iptc['description'] ?? null,
        ];



    }

    private function readImageDir($sourceDir): void
    {
        //dump($sourceDir);
        $images = [];
        foreach ($this->events as $event) {
            $srcDir = $sourceDir .'/'. $event['id']. '/'.config('myapp.album.srcDir');
            if (!is_dir( $srcDir)) {
                throw new Exception('No image directories found in: ' . $this->sourceDir);
            }

            $eventImages = [];
            $imageFiles = glob($srcDir . '/*.{jpg,gif,png}', GLOB_BRACE);
            if (empty($imageFiles)) {
                throw new Exception('No images found in: ' . $srcDir);
            }


            foreach ($imageFiles as $imageFile) {
               $this->parseImageFile($imageFile, $srcDir);
            }
            //dd($imageFiles);
            $eventImages = [];


           /* $images[] = $this->parseCoverDirectories($directories, $sourceDir.'/'.$event['id'], $event['id']);
            dd($images);*/
        }

    }

    private function parseImageFile(string $imageFile, string $srcDir)
    {
        //dump($srcDir);
        if (file_exists($imageFile) && @getimagesize($imageFile,$imageData)) {
           // $cover = $this->url . '/' . $directory . '/'.config('myapp.album.cover');
            $iptc = $this->getIptcData($imageData);
            $fileName = basename($imageFile);
            dump($fileName);

        }else{
            $this->errors[] = 'WARNING: Invalid cover image found in directory: ' . $imageFile;
        }

    }

    private function parseAlbumImage(string $fileName, string $src, array $iptc, string $parentDir): array
    {
        return [
            'id' =>$parentDir .'/' .$fileName,
            'parentId' => $parentDir,
            'src' =>$src,
            'thumbnail' =>$src,
            'title' => $iptc['title'] ?? $fileName,
            'createdAt' => new Carbon($iptc['date'] ?? null),
            'description' =>$iptc['description'] ?? null,
            'author' =>$iptc['author'] ?? null,

        ];



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







    private function storeJsonFile($array, $targetFilePath): void
    {
        if (count($array) > 0) {
            $json = json_encode($array, JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES);
            if ($json === false) {
                $this->errors[] = 'ERROR: Failed to generate JSON from albums array.';
                return;
            }


            if (file_put_contents($targetFilePath, $json) === false) {
                $this->errors[] = 'ERROR: Failed to save JSON to file: ' . $targetFilePath;
            } else {
                $this->success[] = 'SUCCESS: JSON file saved successfully: ' . $targetFilePath;
            }
        } else {
            $this->errors[] = 'WARNING: No albums to save.';
        }
    }

    private function readExifData(string $coverPath): array
    {
        $exifData = @exif_read_data($coverPath, 'ANY_TAG', true);
        // Additionnal informations from Lightroom
        getimagesize( $coverPath, $infos);
        if ( isset($infos['APP13']) ) {
            print_r(iptcparse($infos['APP13']));
        }
         if ($exifData === false) {
            $this->errors[] = 'ERROR: Failed to read EXIF data from image: ' . $coverPath;
            return ['title' => null, 'description' => null];
        }

        $title = $exifData['ImageDescription'] ?? null;
        $description = $exifData['UserComment'] ?? null;

        return ['title' => $title, 'description' => $description];
    }
}
