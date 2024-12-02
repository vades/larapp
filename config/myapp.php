<?php
$myAppNav = require_once 'myapp/myapp_nav.php';
$maAppProjects = require_once 'myapp/myapp_project.php';
return [
    'appName' => env('APP_NAME'),
    'projectId' => $maAppProjects[request()->getHost()]['id'] ?? 1,
    'project' => $maAppProjects[ request()->getHost()]['name'] ?? 'dev',
    'projectLabel' => $maAppProjects[ request()->getHost()]['label'] ?? 'DEV Localhost',
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
        'thumbWidth' => 200,
        'cover' => 'cover.jpg',
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
