<?php

namespace App\Services\Import\Project;

use App\Data\PostData;
use App\Enums\PostStatus;
use App\Models\Post;
use App\Traits\ImportProjectTrait;
use Exception;
use Spatie\YamlFrontMatter\Document;


class ProjectPostService
{
    use ImportProjectTrait;

    public function __construct(string $project)
    {
        $this->project = $project;
        $this->pathToDir = storage_path() . '/app/imports/projects/' . $project . '/posts/';
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
            $this->logErrors();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    private function parseMarkdown(Document $object, string $contentType): void
    {
        $data = new \stdClass();
        $data->uuid= $object->uuid ?? '';
        $data->parent_id= $object->parent_id ?? 0;
        $data->project_id = $object->project_id ?? config('myapp.projects.' . $this->project);
        $data->user_id = $object->user_id ?? 1;
        $data->is_featured = $object->is_featured ?? false;
        $data->post_type = $object->post_type ?? $contentType;
        $data->post_status = $object->post_status ?? PostStatus::DRAFT;
        $data->position = $object->position ?? 0;
        $data->views_count = $object->views_count ?? 0;
        $data->lang = $object->lang ?? app()->getLocale();
        $data->title = str($object->title)->squish();
        $data->subtitle = str($object->subtitle)->squish() ?? '';
        $data->description = str($object->description)->squish() ?? '';
        $data->content =  str($object->body());
        $data->image_url = $object->image_url ?? '';
        $data->tags = $obj->tags ?? null;
        $data->categories = $obj->categories ?? null;
        $this->parseOptions($object, $data);

        $this->storeData(PostData::from($data));


    }

    private function storeData(PostData $data): void
    {


        try {
            Post::updateOrCreate(
                ['uuid' => $data->uuid],
                ['uuid' => $data->uuid,
                    'parent_id' => $data->parent_id,
                    'project_id' => $data->project_id,
                    'user_id' => $data->user_id,
                    'is_featured' => $data->is_featured,
                    'post_type' => $data->post_type,
                    'post_status' => $data->post_status,
                    'position' => $data->position,
                    'views_count' => $data->views_count,
                    'lang' => $data->lang,
                    'title' => $data->title,
                    'subtitle' => $data->subtitle,
                    'description' => $data->description,
                    'content' => $data->content,
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
