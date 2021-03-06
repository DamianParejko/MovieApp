<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Movie;
use App\Models\Comment;
use App\Jobs\CreatePost;
use App\Jobs\DeletePost;
use App\Jobs\UpdatePost;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Middleware\Authenticate;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware([Authenticate::class], ['except' => ['show']]);
    }   

    public function store(PostRequest $request, Movie $movie)
    {  
        $this->dispatchNow(new CreatePost($request->content, $movie));
        
        return redirect()->back()->with('message', 'Komentarz został dodany');
    }

    public function show(Post $post)
    {
        $comments = $post->comment()->paginate(10);
        
        return view('post.show', compact('comments', 'post'));      
    }

    public function edit(Post $post)    
    {
        $this->authorize('edit', $post);
        
        return view('post.edit', compact('post'));
    }

    public function update(PostRequest $request, Post $post)
    {
        $this->authorize('edit', $post);

        $this->dispatchNow(new UpdatePost($post, $request->content));

        return redirect()->route('movie.show', ['movie' => $post->movie_id])->with('message', 'Zmiany zostały zapisane');
    }

    public function destroy(Post $post)
    {   
        $this->authorize('delete', $post);
        
        $this->dispatchNow(new DeletePost($post));
        
        return redirect()->route('movie.show', ['movie' => $post->movie_id])->with('message', 'Komentarz został usunięty');
    }
}
