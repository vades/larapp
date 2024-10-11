<?php

namespace App\Services\Import\Project;

use Exception;
use Spatie\YamlFrontMatter\Document;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class ProjectCategoryService
{
   private array $files = [];

    private array $errors = [];

    private string $pathToDir = '';

    private array $directories = [];

    /**
     * Create a new class instance.
     */
    public function __construct(string $project)
    {
        $this->pathToDir = storage_path().'/app/imports/projects/'.$project.'/categories/';
    }

    /**
     * @throws Exception
     */
    public function handle(): void
    {
        try {
            $this->parseImportDir();
            $this->parseImportFiles();
            $this->parseMarkdownFiles();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        //throw new Exception('CategoryService not implemented');
        /* Log::info('Importing categories to the database');
        dd('Importing categories to the database');*/
    }

    private function parseImportDir(): void
    {

        if(!is_dir($this->pathToDir)) {
            throw new Exception('Failed to read files from directory: ' .  $this->pathToDir);
        }

         $directories = array_filter(glob($this->pathToDir . '/*'), 'is_dir');
        if(empty($directories)) {
            throw new Exception('No directories found in: ' . $this->pathToDir);
        }

        $this->directories = array_map('basename', $directories);
    }

    private function parseImportFiles(): void
    {
        foreach ($this->directories as $directory) {
            $path = $this->pathToDir . $directory;
            $files = glob($path . '/*.md');
            if(empty($files)) {
                $this->errors[] = 'No files found in directory: ' . $path;
                continue;
            }
            $this->files[$directory] = $files;
        }
       // dd($this->files);
    }

    private function parseMarkdownFiles(): void
    {
        foreach ($this->files as $categoryType => $files) {
            foreach ($files as $file) {
                $content = file_get_contents($file);
                if($content === false) {
                    array_push($this->errors,'Failed to read file: ' . $file);
                    continue;
                }
                $object = YamlFrontMatter::parse($content);
                $this->parseMarkdown($object, $categoryType);

            }
        }
    }

    private function parseMarkdown(Document $object, string $categoryType): void
    {
        $data = new \stdClass();
        $data->uuid= $object->uuid ?? '';
        $data->parent_id= $object->parent_id ?? 0;
        $data->project_id = $object->project_id ?? config('myapp.projectId');
        $data->category_type = $categoryType;
        $data->title= $object->title ?? 0;

        $this->createCategory();

        dump($data);

    }

    private function createCategory(): void
    {
        // Create category
    }
}
