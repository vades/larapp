<?php
$myAppNav = [
    'home' => [
        'name' => 'Home',
        'route' => 'home',
        'isExternal' => false,
    ],
    'blog' => [
        'name' => 'Blog',
        'route' => 'blog',
        'isExternal' => false,
    ],
    'places' => [
        'name' => 'Places',
        'route' => 'places',
        'isExternal' => false,
    ],
    'album' => [
        'name' => 'album',
        'route' => 'album',
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
            'blog' => $myAppNav['blog'],
            'places' => $myAppNav['places'],
            'album' => $myAppNav['album'],
    ],
    'supplementaryNav' => [
            'blog' => [
                [
                    'name' => 'Blog',
                    'route' => 'blog',
                    'isExternal' => false,
                ],
                [
                    'name' => 'Blog 2',
                    'route' => 'blog',
                    'isExternal' => false,
                    ],
                [
                    'name' => 'Blog 3',
                    'route' => 'blog',
                    'isExternal' => false,
                ],
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
