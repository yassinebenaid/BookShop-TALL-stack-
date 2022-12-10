<?php

namespace App\Services;

use App\Models\Book;

class FeedbackService
{
    public function getBookFeedback(Book $book)
    {
        return $book->feedback()->with(["user:id,name"])->get();
    }

    public function getFeedbackOfAuthUser(Book $book)
    {
        return $book->feedback()->where("user_id", auth()->id())->first();
    }

    public function createNewFeedback($book_id, array $data)
    {
        auth()->user()->feedback()->create([
            "book_id" => $book_id,
            "body" => $data["feedback"]["body"],
            "rate" => $data["feedback"]["rate"],
        ]);
    }

    public function updateFeedback($book_id, array $data)
    {
        auth()->user()->feedback()->update([
            "body" => $data["feedback"]["body"],
            "rate" => $data["feedback"]["rate"],
        ]);
    }




    public static function instance()
    {
        return new static;
    }
}
