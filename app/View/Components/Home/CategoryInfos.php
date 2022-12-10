<?php

namespace App\View\Components\Home;

use Illuminate\View\Component;

class CategoryInfos extends Component
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.home.category-infos')->with([
            "category" => request("category")?->loadCount("books")
        ]);
    }
}
