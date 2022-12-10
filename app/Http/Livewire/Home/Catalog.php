<?php

namespace App\Http\Livewire\Home;

use App\Services\BookService;
use Livewire\Component;
use Livewire\WithPagination;

class Catalog extends Component
{
    use WithPagination;

    public  $filters = [
        "keywords" => "",
        "year" => null,
        "ages" => [],
        "price" => [
            "max" => null,
            "min" => null
        ]
    ];


    public function updated()
    {
        $this->resetPage();
    }

    public function filterByPrice()
    {
        ["min" => $min, "max" => $max] = $this->filters["price"];

        if (((int)$min && (int)$max) && ((int)$min > (int)$max)) {
            $this->filters["price"]["min"] = $this->filters["price"]['max'] = null;
        };
    }


    public function updatedPage()
    {
        $this->dispatchBrowserEvent("shouldScrollUp");
    }

    public function render()
    {
        return view('livewire.home.catalog')->with([
            "books" => BookService::instance()->fromTheCurrentCategory()->filteredBy($this->filters)->apply(5)
        ]);
    }
}
