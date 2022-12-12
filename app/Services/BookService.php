<?php

namespace App\Services;

use App\Models\Book;
use App\Models\Category;
use App\Traits\DealWithCookies;
use App\Traits\DealWithStrings;
use Illuminate\Support\Facades\Cookie;

class BookService
{
    use DealWithStrings, DealWithCookies;


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
        return Book::orderBy("discount", "desc")->take(6)->with(["wishlist:id", "cart:id"])->get($this->columns);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function getBooksFromStock()
    {
        return Book::inRandomOrder()->take(18)->with(["wishlist:id", "cart:id"])->get($this->columns);
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
    public function getSearchSuggestions($keywords)
    {
        return Book::take(6)->filter(["keywords" => $keywords])->get(["id", "name"]);
    }


    /**
     * Undocumented function
     *
     * @return void
     */
    public function toggleToCart($book_id)
    {
        if (auth()->user()) {
            return auth()->user()->cart()->toggle($book_id);
        }

        return $this->toggleItemInCookies("books:cart", $book_id);
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
        $new_items = $this->removeItemFromJsonCookie("books:cart", $book_id);

        return  Book::select("id", "name", "price", "author", "discount", "release_year")->find($new_items);
    }


    public function getBooksInCart()
    {
        if (auth()->user()) {
            return auth()->user()->cart()->select($this->columns)->get();
        }

        $books_in_cookies = $this->getItemFromJsonCookie("books:cart");

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
                ->with(["wishlist:id", "cart:id"])
                ->paginate($count);
        }

        return Book::select($this->columns)
            ->filter($this->filters)
            ->with(["wishlist:id", "cart:id"])
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
