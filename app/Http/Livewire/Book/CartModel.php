<?php

namespace App\Http\Livewire\Book;

use App\Services\BookService;
use Livewire\Component;

class CartModel extends Component
{
    public $books = [];

    public function refresh()
    {
        $this->books = BookService::instance()->getBooksInCart() ?? [];
    }

    public function removeFromCart($book_id)
    {
        $this->books =  BookService::instance()->removeFromCart($book_id);
    }


    public function render()
    {
        return view('livewire.book.cart-model');
    }
}
