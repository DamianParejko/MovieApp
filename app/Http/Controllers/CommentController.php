<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Jobs\CreateComment;
use App\Jobs\DeleteComment;
use App\Jobs\UpdateComment;
use Illuminate\Http\Request;
use App\Events\CommentCreated;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CommentRequest;
use App\Notifications\NotificationComment;
use App\Http\Requests\StoreCommentsRequest;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Notifications\DatabaseNotification;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware([Authenticate::class]);
    }

    public function store(CommentRequest $request, Post $post)
    {
        $this->dispatchNow(new CreateComment($request->commentary, $post));
            
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
        
        $this->dispatchNow(new UpdateComment($comment, $request->commentary));

        return redirect()->route('post.show', ['post' => $comment->post_id]);
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $this->dispatchNow(new DeleteComment($comment));

        return redirect()->back()->with('message', 'Komentarz usunięto');
    }
}