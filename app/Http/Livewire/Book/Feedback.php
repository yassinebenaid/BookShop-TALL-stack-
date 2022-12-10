<?php

namespace App\Http\Livewire\Book;

use App\Models\Book;
use App\Services\FeedbackService;
use Livewire\Component;

class Feedback extends Component
{
    public $book;
    public $currentUserReview = null;
    public $reviews;
    public $feedback = [
        "rate" => null,
        "body" => null
    ];

    protected $rules = [
        "feedback.rate" => "max:5|min:0",
        "feedback.body" => "max:500|min:5"
    ];

    public function mount(Book $book)
    {
        $this->book = $book;

        $this->reviews = FeedbackService::instance()->getBookFeedback($book);
        $this->currentUserReview = FeedbackService::instance()->getFeedbackOfAuthUser($book);

        if ($this->currentUserReview?->exists) {
            $this->feedback['rate'] = $this->currentUserReview->rate;
            $this->feedback['body'] = $this->currentUserReview->body;
        }
    }

    public function hydrate()
    {
        if (is_null($this->currentUserReview)) $this->currentUserReview = FeedbackService::instance()->getFeedbackOfAuthUser($this->book);
    }

    public function save()
    {
        $data = $this->validate(
            messages: ["feedback.body" => "feedback less than 5 or more than 500 is not acceptable"]
        );

        if ($this->currentUserReview?->exists) {
            FeedbackService::instance()->updateFeedback($this->book->id, $data);
        } else {
            FeedbackService::instance()->createNewFeedback($this->book->id, $data);
        }

        $this->reviews = FeedbackService::instance()->getBookFeedback($this->book);
        $this->dispatchBrowserEvent("success", "Feedback created successfully");
    }

    public function render()
    {
        return view('livewire.book.feedback');
    }
}
