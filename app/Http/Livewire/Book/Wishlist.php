<?php

namespace App\Http\Livewire\Book;

use App\Services\BookService;
use Livewire\Component;

class Wishlist extends Component
{
    public $books = [];


    public function refresh()
    {
        $this->books = BookService::instance()->getFromWishlist();
    }

    public function removeFromWishlist($book_id)
    {
        auth()->user()->wishlist()->detach($book_id);
    }

    public function render()
    {
        return view('livewire.book.wishlist');
    }
}
