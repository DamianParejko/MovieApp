<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Events\CommentCreated;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CommentRequest;
use App\Http\Requests\StoreCommentsRequest;
use Illuminate\Auth\Middleware\Authenticate;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware([Authenticate::class]);
    }

    public function store(CommentRequest $request, Post $post)
    {
        Comment::create([
            'user_id' => Auth::user()->id,
            'post_id' => $post->id,
            'comment' => $request->comment
        ]); 
        
        event(new CommentCreated($post));
        
        return redirect()->back()->with('message', 'Komentarz dodany');
    }

    public function edit(Comment $comment)
    {
        $this->authorize('edit', $comment);
            
        return view('comment.edit', compact('comment'));        
    }

    public function update(CommentRequest $request, Comment $comment)
    {
        $this->authorize('edit', $comment);
        $comment->update($request->only('comment'));

        return redirect()->route('post.show', ['post' => $comment->post_id]);
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $like = DB::table('notifications')
            ->where('data->post->id', $comment->post_id)
            ->where('created_at', $comment->created_at)
            ->where('data->user->id', $comment->user_id)
            ->where('type', 'App\Notifications\NotificationComment');
        
        $comment->delete();
        $like->delete();

        return redirect()->back()->with('message', 'Komentarz usunięto');
    }
}
