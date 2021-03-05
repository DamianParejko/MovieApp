<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\NotificationPostLike;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotificationPostLikeCreated
{
    public function __construct()
    {
        //
    }

    public function handle($event)
    {
        $event->likePost->post->user->notify(new NotificationPostLike($event->likePost));
    }
}
