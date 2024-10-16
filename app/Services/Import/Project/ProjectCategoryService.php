<?php

namespace App\Services\Import\Project;

use App\Data\CategoryData;
use App\Models\Category;
use App\Traits\ImportProjectTrait;
use Exception;
use Spatie\YamlFrontMatter\Document;


class ProjectCategoryService
{
    use ImportProjectTrait;

    public function __construct(string $project)
    {
        $this->project = $project;
        $this->pathToDir = storage_path() . '/app/imports/projects/' . $project . '/categories/';
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
    }

    private function parseMarkdown(Document $object, string $contentType): void
    {
        $data = new \stdClass();
        $data->uuid = $object->uuid ?? '';
        $data->project_id = $object->project_id ?? config('myapp.projects.' . $this->project);
        $data->parent_id = $object->parent_id ?? 0;
        $data->is_published = $object->is_published ?? false;
        $data->category_type = $contentType;
        $data->position = $object->position ?? 0;;
        $data->views_count = $object->views_count ?? 0;
        $data->lang = $object->lang ?? app()->getLocale();
        $data->title = str($object->title)->squish();
        $data->description = str($object->description)->squish() ?? '';
        $data->image_url = $object->image_url ?? '';
        $this->parseOptions($object, $data);

        $this->createCategory(CategoryData::from($data));


    }

    private function createCategory(CategoryData $data): void
    {


        try {
            $category = Category::updateOrCreate(
                ['uuid' => $data->uuid],
                ['uuid' => $data->uuid,
                    'project_id' => $data->project_id,
                    'parent_id' => $data->parent_id,
                    'is_published' => $data->is_published,
                    'category_type' => $data->category_type,
                    'position' => $data->position,
                    'views_count' => $data->views_count,
                    'lang' => $data->lang,
                    'title' => $data->title,
                    'description' => $data->description,
                    'image_url' => $data->image_url,
                    'options' => json_encode($data->options),
                ]
            );
        } catch (Exception $e) {
            $this->errors[] = 'ERROR: Unable to save category: ' . $data->title . ' | '.  $data->uuid;
            $this->errors[] = $e->getMessage();
        }
    }
}
