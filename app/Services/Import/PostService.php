<?php
declare(strict_types=1);


namespace App\Services\Import;

use Exception;
use Illuminate\Support\Facades\Log;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class PostService
{
    # region PROPERTIES
    private string $postType;

    private array $files = [];

    private array $errors = [];

    # endregion PROPERTIES

    # region PROPERTY_ACCESSORS

    public function getPostType(): string
    {
        return $this->postType;
    }

    public function setPostType(string $postType): void
    {
        $this->postType = $postType;
    }
    # endregion PROPERTY_ACCESSORS

    # region METHODS
    public function handle(): void
    {
        try {
            $this->readMarkdownFiles();
            $this->parseMarkdownFiles();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        //throw new Exception('PostService not implemented for type: ' . $this->postType);
        /* Log::info('Importing posts to the database');
        dd('Importing posts to the database');*/

    }
    private function readMarkdownFiles(): void
    {
        $importDirs = config('myapp.importDir');
        $directory = $importDirs[$this->postType] ?? null;
        $path = storage_path().'/'.$directory;
        if ($directory === null) {
            throw new Exception('Invalid post type: ' . $this->postType);
        }

        if(!is_dir( $path)) {
            throw new Exception('Failed to read files from directory: ' .  $path);
        }

        $files = glob( $path . '*.md');
        if(empty($files)) {
            throw new Exception('No files found in directory: ' .  $path);
        }
        $this->files = $files;
    }

    private function parseMarkdownFiles(): void
    {
        foreach ($this->files as $file) {
            $content = file_get_contents($file);
            if($content === false) {
                array_push($this->errors,'Failed to read file: ' . $file);
                continue;
            }
            $object = YamlFrontMatter::parse($content);
            $object->matter();
            dd($object->title);
            //dump( $object->body());
            dump( $object->matter('title'));
            //$this->parseMarkdownContent($content);
        }
    }

    # endregion METHODS
}