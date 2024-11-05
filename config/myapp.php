<?php
$myAppNav = require_once 'myappnav.php';
return [
    'name' => 'MyApp',
    'projectId' => env('PROJECT_ID', 1),
    'importsDir' => 'app/imports/',
    'projects'=> [
        'dev' => 1,
        'ivnbg' => 2,
    ],
    'importDir' => [
        'post' => 'app/imports/posts/',
        'place' => 'app/imports/places/',
    ],
    'album' => [
        'dir' => [
            'source' => storage_path().'/app/albums',
            'target' =>  storage_path().'/app/albums',
        ],
        'file' => [
            'album' => 'albums.json',
            'event' => 'events.json',
            'image' => 'images.json',

        ],
        'srcDir' => 'src',
        'thumbDir' => 'thumb',
        'cover' => 'cover.jpg',
        'url' => 'https://myapp.com/albums',
    ],
    'headerNav' => [
            'blog' => $myAppNav['blogList'],
            'places' => $myAppNav['placeList'],
            'album' => $myAppNav['albumList'],
    ],
    'supplementaryNav' => [
            'blog' => [
                $myAppNav['blogList'],
                $myAppNav['blogItem'],
                $myAppNav['blogCategoryList'],
                $myAppNav['blogTagList'],
            ],
            'place' =>[
                $myAppNav['placeList'],
                $myAppNav['placeItem'],
                $myAppNav['placeCategoryList'],
            ],
            'album' => [
                $myAppNav['albumList'],
                $myAppNav['albumEventList'],
                $myAppNav['albumGallery'],

            ],
        ],
    'footerNav' => [
            $myAppNav['home'],
            $myAppNav['contact'],
            $myAppNav['about'],
    ],

];
