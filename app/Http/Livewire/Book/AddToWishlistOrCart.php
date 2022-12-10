<?php

namespace App\Http\Livewire\Book;

use Livewire\Component;

class AddToWishlistOrCart extends Component
{
    public $liked = false;
    public $book;

    public function mount($book)
    {
        $this->book = $book;
        $this->liked = (bool)$book->wishlist->where("id", auth()->id())->first();
    }


    public function addToWishlist()
    {
        $attachmentStatus = auth()->user()->wishlist()->toggle($this->book->id);

        if ($this->liked = !empty($attachmentStatus["attached"])) {
            $this->dispatchBrowserEvent("new-item");
        }
    }


    public function render()
    {
        return view('livewire.book.add-to-wishlist-or-cart');
    }
}
