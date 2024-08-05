<?php

namespace App\Models;

class Tag
{
    public static function allTags(): array
    {
        return [
            (object)[
                'id' => 1,
                'title' => 'Tag 1',
                'description' => 'Tag 1 description',
                'image' => 'tag1.jpg',
            ],
            (object)[
                'id' => 2,
                'title' => 'Tag 2',
                'description' => 'Tag 2 description',
                'image' => 'tag2.jpg',
            ],
            (object)[
                'id' => 3,
                'title' => 'Tag 3',
                'description' => 'Tag 3 description',
                'image' => 'tag3.jpg',
            ],
        ];
    }

    public static function findTag(int $id): object
    {
        return (object)[
            'id' => $id,
            'title' => 'Tag ' . $id,
            'description' => 'Tag ' . $id . ' description',
            'image' => 'tag' . $id . '.jpg',
        ];
    }

}
