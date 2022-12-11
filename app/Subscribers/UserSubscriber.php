<?php

namespace App\Subscribers;

use App\Events\UserSignedIn;
use App\Listeners\MigrateBooksFromCookiesToDatabase;
use Illuminate\Events\Dispatcher;

class UserSubscriber
{
    public function subscribe(Dispatcher $event)
    {
        $event->listen(UserSignedIn::class, MigrateBooksFromCookiesToDatabase::class);
    }
}
