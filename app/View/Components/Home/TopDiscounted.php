<?php

namespace App\View\Components\Home;

use App\Services\BookService;
use Illuminate\View\Component;

class TopDiscounted extends Component
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.home.top-discounted')->with([
            "books" => cache()->remember("books:discounted", 360, fn () => BookService::instance()->getTopDiscounted())
        ]);
    }
}
