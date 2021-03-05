<?php

namespace App\Events;

use App\Models\LikePost;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PostLikeCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $likePost;

    public function __construct(LikePost $likePost)
    {
        $this->likePost = $likePost;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
