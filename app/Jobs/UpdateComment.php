<?php

namespace App\Jobs;

use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class UpdateComment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $comment;
    protected $commentary;

    public function __construct(Comment $comment, string $commentary)
    {
        $this->comment = $comment;
        $this->commentary = $commentary;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->comment->update(['comment' => $this->commentary ]);
    }
}
