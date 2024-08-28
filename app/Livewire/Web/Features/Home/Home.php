<?php

namespace App\Livewire\Web\Features\Home;
use Illuminate\Support\Str;

use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        $html = Str::of('# Laravel - first - second')->markdown();

        return view('livewire.web.features.home.home')->with('html', $html);
    }
}
