<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Cookie;

class MigrateBooksFromCookiesToDatabase
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $books = json_decode(request()->cookie("books:cart"));

        if ($books) auth()->user()->cart()->attach($books);

        Cookie::queue(Cookie::forget("books:cart"));
    }
}
