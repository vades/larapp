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
        $data->title = $object->title ?? 0;
        $data->title = str($object->title)->squish();
        $data->description = $object->description ?? '';
        $data->image_url = $object->image_url ?? '';
        $data->options = array_filter((array)$object->matter(), function ($key) use ($data) {
            return !property_exists($data, $key) && strpos($key, "\x00*\x00") === false;
        },
                                      ARRAY_FILTER_USE_KEY
        );
        $categoryData = CategoryData::from($data);

        $this->createCategory($categoryData);


    }

    private function createCategory(CategoryData $categoryData): void
    {


        try {
            $category = Category::updateOrCreate(
                ['uuid' => $categoryData->uuid],
                ['uuid' => $categoryData->uuid,
                    'project_id' => $categoryData->project_id,
                    'parent_id' => $categoryData->parent_id,
                    'is_published' => $categoryData->is_published,
                    'category_type' => $categoryData->category_type,
                    'position' => $categoryData->position,
                    'views_count' => $categoryData->views_count,
                    'lang' => $categoryData->lang,
                    'title' => $categoryData->title,
                    'description' => $categoryData->description,
                    'image_url' => $categoryData->image_url,
                    'options' => json_encode($categoryData->options),
                ]
            );
        } catch (Exception $e) {
            $this->errors[] = 'ERROR: Unable to save category: ' . $categoryData->title . ' | '.  $categoryData->uuid;
            $this->errors[] = $e->getMessage();
        }
    }
}
