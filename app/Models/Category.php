<?php

namespace App\Models;

class Category
{
    public static function allCategories(): array
    {
        return [
            (object)[
                'id' => 1,
                'title' => 'Category 1',
                'description' => 'Category 1 description',
                'image' => 'category1.jpg',
            ],
            (object)[
                'id' => 2,
                'title' => 'Category 2',
                'description' => 'Category 2 description',
                'image' => 'category2.jpg',
            ],
            (object)[
                'id' => 3,
                'title' => 'Category 3',
                'description' => 'Category 3 description',
                'image' => 'category3.jpg',
            ],
        ];
    }

    public static function findCategory(int $id): object
    {
        return (object)[
            'id' => $id,
            'title' => 'Category ' . $id,
            'description' => 'Category ' . $id . ' description',
            'image' => 'category' . $id . '.jpg',
        ];
    }
}
