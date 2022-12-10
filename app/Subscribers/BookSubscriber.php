<?php

namespace App\Subscribers;

use App\Events\UserIntractsWithBookCard;
use App\Listeners\ClearBooksFromCache;
use Illuminate\Events\Dispatcher;

class BookSubscriber
{
    public function subscribe(Dispatcher $event)
    {
        $event->listen(UserIntractsWithBookCard::class, ClearBooksFromCache::class);
    }
}
