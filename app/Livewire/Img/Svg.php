<?php

namespace App\Livewire\Img;

use Livewire\Component;

class Svg extends Component
{
    public string $filename = '';

    public string $classList = '';
    public function render()
    {
        $img = 'assets/img/svg/'.$this->filename.'.svg';
        return view('livewire.img.svg')->with('img', $img);
    }
}
