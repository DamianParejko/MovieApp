<?php

namespace App\Jobs;

use App\Models\Post;
use Illuminate\Support\Arr;
use Illuminate\Bus\Queueable;
use App\Http\Requests\PostRequest;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class UpdatePost implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $post;
    private $content;

    public function __construct(Post $post, string $content)
    {
        $this->post = $post;
        //$this->receiver = Arr::only($receiver, ['content']);
        $this->content = $content;
    }

    // public static function fromRequest(Post $post, PostRequest $request)
    // {
    //     return new static($post, [
    //         'content' => $request->content
    //     ]);
    // }

    public function handle()
    {
        $this->post->update(['content' => $this->content]);
    }
}
