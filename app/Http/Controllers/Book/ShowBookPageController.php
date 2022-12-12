<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class ShowBookPageController extends Controller
{
    public function __invoke(Book  $book)
    {
        return view("book.show")->with([
            "book" => $book->load(["category:id,name", "cart:id"])->loadAvg("feedback", "rate"),
            "similars" => $book->category->books()->take(5)->with(["wishlist:id", "cart:id"])->get(["id", "name", "price", "discount", "images", "author", "release_year"]),
        ]);
    }
}
