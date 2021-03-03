<?php

namespace App\Jobs;

use App\Models\Post;
use App\Models\Movie;
use Illuminate\Bus\Queueable;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class CreatePost implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $content;
    private $movie;

    public function __construct(string $content, Movie $movie)
    {
        $this->content = $content;
        $this->movie = $movie;
    }

    public function handle()
    {
        $post = new Post([
            'user_id' => Auth::user()->id,
            'movie_id' => $this->movie->id,
            'content' => $this->content
        ]);

        $post->save();
        return $post;
    }
}
