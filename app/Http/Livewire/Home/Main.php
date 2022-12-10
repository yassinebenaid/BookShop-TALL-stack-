<?php

namespace App\Http\Livewire\Home;

use App\Services\CategoryService;
use Livewire\Component;

class Main extends Component
{
    public bool $catalogIsShown = false;



    public function render()
    {
        return view('livewire.home.main');
    }
}
