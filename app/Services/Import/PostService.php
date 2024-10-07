<?php
declare(strict_types=1);


namespace App\Services\Import;

use App\Data\PostData;
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
            $data = new \stdClass();
            $data->parent_id= $object->parent_id ?? 0;
            $data->project_id = $object->project_id ?? config('myapp.projectId');
            $data->user_id = $object->user_id ?? 1;
            $data->is_featured = $object->is_featured ?? false;
            $data->post_type = $object->post_type ?? $this->postType;
            $data->post_status = $object->post_status ?? 'draft';
            $data->position = $object->position ?? 0;
            $data->views_count = $object->views_count ?? 0;
            $data->slug = $object->slug ?? '';
            $data->lang = $object->lang ?? 'en';
            $data->title = str($object->title)->squish();
            $data->subtitle = str($object->subtitle)->squish() ?? '';
            $data->description = str($object->description)->squish() ?? '';
            $data->content =  str($object->body())->squish();
            $data->image_url = $object->image_url ?? '';

            // Function takes all $object properties that are not listed in $data properties and creates an array that
            // will be the content of options.
            $data->options = array_filter((array) $object->matter(), function ($key) use ($data) {
                    return !property_exists($data, $key) && strpos($key, "\x00*\x00") === false;
                },
                ARRAY_FILTER_USE_KEY
            );

            //dd($data);

            $post = PostData::from($data);

            //$object->matter();
            dd($post->toArray());
            //dump( $object->body());
            dump( $object->matter('title'));
            //$this->parseMarkdownContent($content);
        }
    }

    # endregion METHODS
}