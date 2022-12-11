<?php

namespace App\Http\Livewire\Book;

use App\Events\UserIntractsWithBookCard;
use App\Models\Book as ModelsBook;
use App\Services\BookService;
use Livewire\Component;

class BookCard extends Component
{
    public ModelsBook $book;
    public $liked = false;
    public $inCart = false;
    public bool $withDiscount = false;


    public function mount(ModelsBook $book, bool $withDiscount = false)
    {
        $this->book = $book;
        $this->withDiscount = $withDiscount;

        $this->liked = (bool)$book->wishlist->where("id", auth()->id())->first();
    }

    public function addToWishlist()
    {
        $attachmentStatus = auth()->user()->wishlist()->toggle($this->book->id);

        if ($this->liked = !empty($attachmentStatus["attached"])) {
            $this->dispatchBrowserEvent("new-item");
        }

        event(new UserIntractsWithBookCard);
    }

    public function toggleToCart()
    {
        $result = BookService::instance()->toggleToCart($this->book->id);

        $this->inCart = !empty($result["attached"]);
    }


    public function render()
    {
        return view('livewire.book.book-card');
    }
}
