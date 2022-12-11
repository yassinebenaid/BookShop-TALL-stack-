<?php

namespace App\Services;

use App\Models\Book;
use App\Models\Category;
use App\Traits\DealWithStrings;
use Illuminate\Support\Facades\Cookie;

class BookService
{
    use DealWithStrings;


    protected array|object $filters = [];
    protected Category|null $currentCategory = null;
    protected $columns = ["id", "name", "price", "discount", "images", "author", "release_year"];


    /**
     * Undocumented function
     *
     * @return void
     */
    public function getTopDiscounted()
    {
        return Book::orderBy("discount", "desc")->take(6)->with("wishlist:id")->get($this->columns);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function getBooksFromStock()
    {
        return Book::inRandomOrder()->take(18)->with("wishlist:id")->get($this->columns);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function getFromWishlist()
    {
        return auth()->user()->wishlist()->get(["id", "name", "price", "author", "discount", "release_year"]);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function addToCart($book_id)
    {
        if (auth()->user()) {
            return auth()->user()->cart()->sync($book_id);
        }

        return $this->saveBooksInCookies($book_id);
    }

    private function saveBooksInCookies($book_id)
    {
        $cookies = collect(json_decode(request()->cookie("books:cart")));

        $cookies->add($book_id);

        Cookie::queue("books:cart", $cookies->toJson(), 60 * 60 * 5);

        return $cookies;
    }

    public function removeFromCart($book_id)
    {
        if (auth()->user()) {
            auth()->user()->cart()->detach($book_id);
            return auth()->user()->cart()->get($this->columns);
        }

        return $this->removeBookFromCookies($book_id);
    }

    private function removeBookFromCookies($book_id)
    {
        $newCooky = collect(json_decode(request()->cookie("books:cart")))->filter(fn ($el) => $el !== $book_id);

        Cookie::queue("books:cart", $newCooky->toJson(), 60 * 60 * 5);

        return  Book::select("id", "name", "price", "author", "discount", "release_year")->find($newCooky);;
    }


    public function getBooksInCart()
    {
        if (auth()->user()) {

            return auth()->user()->cart()->select($this->columns)->get();
        }

        $books_in_cookies =  collect(json_decode(request()->cookie("books:cart")))->toArray();


        return  Book::select("id", "name", "price", "author", "discount", "release_year")->find($books_in_cookies);
    }


    /**
     * Undocumented function
     *
     * @param array $filters
     * @return static
     */
    public function filteredBy(array $filters = []): static
    {
        $this->filters["keywords"] = $this->iliminateShortWords($filters["keywords"]);
        $this->filters["price"] = $filters["price"];
        $this->filters["year"] = $filters["year"] != "any" ? $filters["year"] : false;
        $this->filters["ages"] = $filters["ages"];
        return $this;
    }


    /**
     * Undocumented function
     *
     * @return void
     */
    public function fromTheCurrentCategory()
    {
        if (request('category')?->exists ?? false) {

            $this->currentCategory = request("category");

            session()->forget("category");
            session()->remember('category', fn () =>  request()->category);
        }

        $this->currentCategory = session("category");

        return $this;
    }

    /**
     * Undocumented function
     *
     * @param integer $count
     * @return void
     */
    public function apply(int $count = 25)
    {
        if ($this->currentCategory) {
            return $this->currentCategory->books()
                ->select($this->columns)
                ->filter($this->filters)
                ->with("wishlist:id")
                ->paginate($count);
        }

        return Book::select($this->columns)
            ->filter($this->filters)
            ->with("wishlist:id")
            ->paginate($count);
    }

    /**
     * Undocumented function
     *
     * @return object
     */
    public static function instance()
    {
        return new static;
    }
}
