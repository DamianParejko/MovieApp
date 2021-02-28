<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\NotificationComment;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotificationCommentCreated
{
    public function handle($event)
    {
        if($event->post->user_id != Auth::user()->id){
            $event->post->user->notify(new NotificationComment($event->post));
        }
    }
}
