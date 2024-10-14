<?php

namespace App\Enums;

enum ContentType: string
{
    case PAGE = 'page';
    case POST = 'post';
    case PLACE= 'place';
}