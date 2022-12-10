<?php

namespace App\View\Components\Home;

use App\Services\CategoryService;
use Illuminate\View\Component;

class Categories extends Component
{


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.home.categories')->with([
            "categories" => cache()->remember("categories", 3600, fn () => CategoryService::instance()->getAllcategories())
        ]);
    }
}
