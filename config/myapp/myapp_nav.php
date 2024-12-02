<?php
return [
    'home' => [
        'name' => 'home',
        'uri' => 'home',
        'isExternal' => false,
    ],
    'blogList' => [
        'name' => 'blogList',
        'uri' => 'blog',
        'isExternal' => false,
    ],
    'blogItem' => [
        'name' => 'blogItem',
        'uri' => 'blog/item-slug',
        'isExternal' => false,
        'params' => ['postId' => 'item-slug']
    ],
    'blogCategoryList' => [
        'name' => 'blogCategoryList',
        'uri' => 'blog/categories',
        'isExternal' => false,
    ],
    'blogTagList' => [
        'name' => 'blogTagList',
        'uri' => 'blog/tags',
        'isExternal' => false,
    ],
    'placeList' => [
        'name' => 'placeList',
        'uri' => 'places',
        'isExternal' => false,

    ],
    'placeItem' => [
        'name' => 'placeItem',
        'uri' => 'places/place-item',
        'isExternal' => false,
        'params' => ['placeId' => 'place-item-slug'],
    ],
    'placeCategoryList' => [
        'name' => 'placeCategoryList',
        'uri' => 'places/categories',
        'isExternal' => false,
    ],
    'albumList' => [
        'name' => 'albumList',
        'uri' => 'albums',
        'isExternal' => false,
    ],
    'albumEventList' => [
        'name' => 'albumEventList',
        'uri' => 'albums/album-id',
        'isExternal' => false,
        'params' => ['albumId' => 'album-id'],
    ],
    'albumGallery' => [
        'name' => 'albumGallery',
        'uri' => 'albums/album-id/event-id',
        'isExternal' => false,
        'params' => ['albumId' => 'album-id', 'eventId' => 'event-id'],
    ],
    'contact' => [
        'name' => 'pageItem',
        'uri' => 'contact',
        'isExternal' => false,
        'params' => ['pageId' => 'contact'],
    ],
    'about' => [
        'name' => 'pageItem',
        'uri' => 'about',
        'isExternal' => false,
        'params' => ['pageId' => 'about'],
    ],
];