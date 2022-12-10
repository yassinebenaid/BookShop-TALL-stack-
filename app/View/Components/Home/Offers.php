<?php

namespace App\View\Components\Home;

use Illuminate\View\Component;

class Offers extends Component
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
        return view('components.home.offers')->with([
            "total" => 3,
            "images" => [
                "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQp2IhTPdR5-OfDamge4Xda1EujFSWBNOfcAQd_wnXQrZu5lVYM2Gf1vHNEgapiOJQDWfE&usqp=CAU",
                "https://www.hollywoodreporter.com/wp-content/uploads/2022/04/2022_04_06-books.jpg?w=1024",
                "https://www.wfla.com/wp-content/uploads/sites/71/2022/01/BOOK-STILL0.jpg?strip=1",
            ]
        ]);
    }
}
