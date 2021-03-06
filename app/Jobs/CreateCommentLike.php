<?php

namespace App\Jobs;

use App\Models\Comment;
use App\Models\LikeComment;
use Illuminate\Bus\Queueable;
use App\Events\CommentLikeCreated;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class CreateCommentLike implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $likeComment = new LikeComment([
            'user_id' =>  Auth::user()->id,
            'comment_id' => $this->comment->id,
            'likeable_id' => 1
        ]);

        $likeComment->save();

        event(new CommentLikeCreated($likeComment));

        return $likeComment;
    }
}
