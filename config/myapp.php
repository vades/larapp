<?php
$myAppNav = [
    'home' => [
        'name' => 'Home',
        'route' => 'home',
        'isExternal' => false,
    ],
    'blogList' => [
        'name' => 'blogList',
        'route' => 'blog',
        'isExternal' => false,
    ],
    'blogItem' => [
        'name' => 'blogItem',
        'route' => 'blog/item-slug',
        'isExternal' => false,
        'params' => ['postId' => 'item-slug']
    ],
    'blogCategoryList' => [
        'name' => 'blogCategoryList',
        'route' => 'blog/categories',
        'isExternal' => false,
    ],
    'blogTagList' => [
        'name' => 'blogTagList',
        'route' => 'blog/tags',
        'isExternal' => false,
    ],
    'placeList' => [
        'name' => 'placeList',
        'route' => 'places',
        'isExternal' => false,
    ],
    'placeItem' => [
        'name' => 'placeItem',
        'route' => 'places/place-item',
        'isExternal' => false,
    ],
    'placeCategoryList' => [
        'name' => 'placeCategoryList',
        'route' => 'places/categories',
        'isExternal' => false,
    ],
    'albumList' => [
        'name' => 'albumList',
        'route' => 'albums',
        'isExternal' => false,
    ],
    'albumEventList' => [
        'name' => 'albumEventList',
        'route' => 'albums/album-id',
        'isExternal' => false,
    ],
    'albumGallery' => [
        'name' => 'albumGallery',
        'route' => 'albums/album-id/event-id',
        'isExternal' => false,
    ],
    'contact' => [
        'name' => 'Contact',
        'route' => 'contact',
        'isExternal' => false,
    ],
    'about' => [
        'name' => 'About',
        'route' => 'about',
        'isExternal' => false,
    ],
];
return [
    'name' => 'MyApp',
    'headerNav' => [
            'blog' => $myAppNav['blogList'],
            'places' => $myAppNav['placeList'],
            'album' => $myAppNav['albumList'],
    ],
    'supplementaryNav' => [
            'blog' => [
                $myAppNav['blogList'],
                $myAppNav['blogItem'],
            ],
            'place' =>[
                [
                    'name' => 'Places',
                    'route' => 'places',
                    'isExternal' => false,
                ],
                [
                    'name' => 'Places 2',
                    'route' => 'places',
                    'isExternal' => false,
                ],
                [
                    'name' => 'Places 3',
                    'route' => 'places',
                    'isExternal' => false,
                ],
            ],
            'album' => [
                [
                    'name' => 'album',
                    'route' => 'album',
                    'isExternal' => false,
                ],
                [
                    'name' => 'album 2',
                    'route' => 'album',
                    'isExternal' => false,
                ],
                [
                    'name' => 'album 3',
                    'route' => 'album',
                    'isExternal' => false,
                ]
    ],
        ],
    'footerNav' => [
            'home' => $myAppNav['home'],
            'contact' => $myAppNav['contact'],
            'about' => $myAppNav['about'],
    ],

];
