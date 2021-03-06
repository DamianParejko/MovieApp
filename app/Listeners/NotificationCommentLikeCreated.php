<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\NotificationCommentLike;

class NotificationCommentLikeCreated
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

    public function handle($event)
    {
        $event->likeComment->comment->user->notify(new NotificationCommentLike($event->likeComment));
    }
}
