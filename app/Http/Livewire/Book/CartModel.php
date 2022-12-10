<?php

namespace App\Http\Livewire\Book;

use Livewire\Component;

class CartModel extends Component
{
    public function refresh()
    {
    }


    public function render()
    {
        return view('livewire.book.cart-model');
    }
}
