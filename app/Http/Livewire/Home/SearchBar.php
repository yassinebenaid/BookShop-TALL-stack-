<?php

namespace App\Http\Livewire\Home;

use App\Services\BookService;
use Livewire\Component;

class SearchBar extends Component
{
    public $search = "";
    public $suggestions = [];

    protected $queryString = ["search" => ["except" => "", "as" => "q"]];


    public function updatedSearch($value)
    {
        $this->suggestions = BookService::instance()->getSearchSuggestions($value);
    }


    public function render()
    {
        return view('livewire.home.search-bar');
    }
}
