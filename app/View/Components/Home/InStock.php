<?php

namespace App\View\Components\Home;

use App\Services\BookService;
use Illuminate\View\Component;

class InStock extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.home.in-stock')->with([
            "books" => cache()->remember('books:stock', 3600, fn () => BookService::instance()->getBooksFromStock())
        ]);
    }
}
