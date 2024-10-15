<?php

namespace App\Traits;

use Exception;
use Illuminate\Database\Eloquent\Builder;
use Spatie\YamlFrontMatter\YamlFrontMatter;

trait ImportProjectTrait
{

    private string $project;
    private array $files = [];

    private array $errors = [];

    public function getErrors(): array
    {
        return $this->errors;
    }

    private string $pathToDir;

    private array $directories = [];
    private function parseImportDir(): void
    {

        if (!config()->has('myapp.projects.' . $this->project)) {
            throw new Exception('No valid project name: ' . $this->project);
        }
        if (!is_dir($this->pathToDir)) {
            throw new Exception('Failed to read files from directory: ' . $this->pathToDir);
        }

        $directories = array_filter(glob($this->pathToDir . '/*'), 'is_dir');
        if (empty($directories)) {
            throw new Exception('No directories found in: ' . $this->pathToDir);
        }

        $this->directories = array_map('basename', $directories);
    }

    private function parseImportFiles(): void
    {
        foreach ($this->directories as $directory) {
            $path = $this->pathToDir . $directory;
            $files = glob($path . '/*.md');
            if (empty($files)) {
                $this->errors[] = 'No files found in directory: ' . $path;
                continue;
            }
            $this->files[$directory] = $files;
        }
        // dd($this->files);
    }

    private function parseMarkdownFiles(): void
    {
        foreach ($this->files as $contentType => $files) {
            foreach ($files as $file) {
                $content = file_get_contents($file);
                if ($content === false) {
                    array_push($this->errors, 'Failed to read file: ' . $file);
                    continue;
                }
                $object = YamlFrontMatter::parse($content);
                $this->parseMarkdown($object, $contentType);

            }
        }
    }
}