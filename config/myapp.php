<?php
use Illuminate\Http\Request;


$myAppNav = require_once 'myapp/myapp_nav.php';
$myAppProjects = require_once 'myapp/myapp_project.php';
return [
    'appName' => env('APP_NAME'),
    'projectId' => $myAppProjects[(new Request)->getHost()]['id'] ?? 1,
    'project' => $myAppProjects[(new Request)->getHost()]['name'] ?? 'dev',
    'name' => $myAppProjects[(new Request)->getHost()]['label'] ?? 'Larapp',
    'slogan' => $myAppProjects[(new Request)->getHost()]['slogan'] ?? 'Larapp dev version',
    'metaTitle' => $myAppProjects[(new Request)->getHost()]['metaTitle'] ?? 'Larapp DEV',
    'metaDescription' => $myAppProjects[(new Request)->getHost()]['metaDescription'] ?? 'Larapp dev version',
    'metaKeywords' => $myAppProjects[(new Request)->getHost()]['metaKeywords'] ?? 'development, laravel, php',
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
