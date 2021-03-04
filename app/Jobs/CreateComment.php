<?php

namespace App\Jobs;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Bus\Queueable;
use App\Events\CommentCreated;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class CreateComment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $commentary;
    private $post;

    public function __construct(string $commentary, Post $post)
    {
        $this->commentary = $commentary;
        $this->post = $post;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $comment = new Comment([
            'user_id' => Auth::user()->id,
            'post_id' => $this->post->id,
            'comment' => $this->commentary
        ]);

        $comment->save();

        event(new CommentCreated($comment));
        
        return $comment;
    }
}
