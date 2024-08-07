<?php

namespace App\Http\Controllers\Web\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PageItemController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): View
    {
        $page =  (object)[
            'title' => 'Page title',
            'subtitle' => 'Page subtitle',
            'description' => 'Orem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. ',
            'content' => Str::of('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.

Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.

- Lorem ipsum dolor sit amet
- Consectetur adipiscing elit
- Sed do eiusmod tempor incididunt
- Ut labore et dolore magna aliqua')->markdown(),
            'metaTitle' => 'Page Meta Title',
            'keywords' => 'Page keywords',
            'metaDescription' => 'Page meta description',
            'imageUrl' => asset('https://picsum.photos/300/300'),
        ];

        //$page = (object)$page;
        return view('components.web.features.page.page-item',[
            'page' => $page]);
    }
}
