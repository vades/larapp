<?php

namespace App\Services\Album;

use Exception;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DataResource
{
    public array $data = [];
    public string $message = '';
    public string $createdAt = '';
     public array $meta = [
        'total' => 0,
    ];
}

class AlbumGeneratorService
{
    private string $sourceDir;
    private string $targetDir;

    private string $url;

    private  DataResource $albums;
    private DataResource $events;
    private DataResource $images;

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
        $this->images = new DataResource();
        $this->albums = new DataResource();
        $this->events = new DataResource();

    }

    /**
     * @throws Exception
     */
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
        $this->albums->data = $this->parseCoverFiles($directories, $sourceDir);
        $filePath =  config('myapp.album.dir.target').'/'.config('myapp.album.file.album');

       $this->storeJsonFile($this->albums , $filePath);
    }
    private function readEventDir($sourceDir): void
    {
        $events = [];
        foreach ($this->albums->data as $album) {
             $directories = array_filter(glob($sourceDir .'/'. $album['id'].'/*'), 'is_dir');


            if (empty($directories)) {
                throw new Exception('No event directories found in: ' . $this->sourceDir);
            }

            $directories = array_map('basename', $directories);

            $events[] = $this->parseCoverFiles($directories, $sourceDir.'/'.$album['id'], $album['id']);
        }

        $this->events->data = array_merge(...$events);;
        $targetFilePath =  config('myapp.album.dir.target').'/'.config('myapp.album.file.event');
        $this->storeJsonFile($this->events, $targetFilePath);

    }

    private function parseCoverFiles(array $directories, string $sourceDir, ?string $parentDir = null): array
    {

        $items = [];
        foreach ($directories as $directory) {
            $path = $sourceDir . '/' . $directory;
            $coverPath = $path . '/' . config('myapp.album.cover');
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
            $options = [
                'id' =>($parentDir ? $parentDir .'/':'') .$directory,
                'directory' => $directory,
                'parentId' => $parentDir ?? null,
                'src' => $cover,
                'thumbnail' =>null,
                'iptc' => $this->getIptcData($imageData),
            ];
            $items[] =$this->parseAlbumImage($options);


        }

        return $items;
    }

    private function readImageDir($sourceDir): void
    {
       foreach ($this->events->data as $event) {
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

               $this->parseImageFile($imageFile, $event);
            }
        }

        $targetFilePath =  config('myapp.album.dir.target').'/'.config('myapp.album.file.image');

        $this->storeJsonFile($this->images, $targetFilePath);

    }



    private function parseImageFile(string $imageFile, array $event): void
    {

        if (file_exists($imageFile) && @getimagesize($imageFile,$imageData)) {
            $fileName = basename($imageFile);
            $imagePath = $event['id'].'/'.config('myapp.album.srcDir').'/'.$fileName;
            $thumbPath = $event['id'].'/'.config('myapp.album.thumbDir').'/'.$fileName;
            $options = [
                'id' => $imagePath,
                'directory' => $event['directory'],
                'parentId' => $event['id'],
                'src' => $this->url . '/' . $imagePath,
                'thumbnail' =>$this->url . '/' . $thumbPath,
                'iptc' => $this->getIptcData($imageData),
                //'exif' => @exif_read_data($imageFile, 'ANY_TAG', true),
            ];
            $this->images->data[] = $this->parseAlbumImage($options);


        }else{
            $this->errors[] = 'WARNING: Invalid  image found: ' . $imageFile;
        }

    }

    private function parseAlbumImage(array $options): array
    {
        return [
            'id' => $options['id'],
            'directory' => $options['directory'],
            'parentId' => $options['parentId'],
            'src' => $options['src'],
            'thumbnail' => $options['thumbnail'] ?? null,
            'title' => $options['iptc']['title'] ?? $options['directory'],
            'createdAt' => new Carbon($options['iptc']['date'] ?? null),
            'description' => $options['iptc']['description'] ?? null,
            'author' => $options['iptc']['author'] ?? null,
           // 'exif' => $options['exif'] ?? null,


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

    private function generateThumbnail(string $imageFile, string $thumbPath, int $thumbWidth = 150): bool
    {
        $imageInfo = getimagesize($imageFile);
        if ($imageInfo === false) {
            $this->errors[] = 'ERROR: Failed to get image size for: ' . $imageFile;
            return false;
        }

        list($width, $height) = $imageInfo;
        $thumbHeight = intval($height * $thumbWidth / $width);

        $thumbnail = imagecreatetruecolor($thumbWidth, $thumbHeight);

        switch ($imageInfo['mime']) {
            case 'image/jpeg':
                $source = imagecreatefromjpeg($imageFile);
                break;
            case 'image/png':
                $source = imagecreatefrompng($imageFile);
                break;
            case 'image/gif':
                $source = imagecreatefromgif($imageFile);
                break;
            default:
                $this->errors[] = 'ERROR: Unsupported image type for: ' . $imageFile;
                return false;
        }

        imagecopyresampled($thumbnail, $source, 0, 0, 0, 0, $thumbWidth, $thumbHeight, $width, $height);

        switch ($imageInfo['mime']) {
            case 'image/jpeg':
                imagejpeg($thumbnail, $thumbPath);
                break;
            case 'image/png':
                imagepng($thumbnail, $thumbPath);
                break;
            case 'image/gif':
                imagegif($thumbnail, $thumbPath);
                break;
        }

        imagedestroy($source);
        imagedestroy($thumbnail);

        return true;
    }

    private function storeJsonFile($dataResource, $targetFilePath): void
    {

        if (count($dataResource->data) > 0) {
            $dataResource->createdAt = date('Y-m-d H:i:s');
            $dataResource->message = 'OK 200';
            $dataResource->meta['total'] = count($dataResource->data);

            $json = json_encode($dataResource, JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES);
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
