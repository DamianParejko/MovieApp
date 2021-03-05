<?php

namespace App\Jobs;

use App\Models\Post;
use App\Models\LikePost;
use Illuminate\Bus\Queueable;
use App\Events\PostLikeCreated;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class CreateLike implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $likePost = new LikePost([
            'user_id' => Auth::user()->id,
            'post_id' => $this->post->id,
            'likeable_id' => 1
        ]);

        $likePost->save();

        event(new PostLikeCreated($likePost));

        return $likePost;
    }
}
