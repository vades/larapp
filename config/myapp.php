<?php
$myAppNav = require_once 'myappnav.php';
return [
    'name' => 'MyApp',
    'projectId' => env('PROJECT_ID', 1),
    'importDir' => [
        'post' => 'app/imports/posts/',
        'place' => 'app/imports/places/',
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
