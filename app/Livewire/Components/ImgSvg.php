<?php

namespace App\Livewire\Components;

use Livewire\Component;

class ImgSvg extends Component
{
    public string $filename = '';

    public string $classList = '';

    public function render()
    {
        $img = 'assets/img/svg/' . $this->filename . '.svg';
        return view('livewire.img.svg')->with('img', $img);
    }
}
