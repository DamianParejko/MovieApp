<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\LikeComment;
use Illuminate\Http\Request;
use App\Events\CommentLikeCreated;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NotificationCommentLike;

class LikeCommentController extends Controller
{

    public function like(Comment $comment)
    {
        $this->authorize('like', $comment);
    
        if($comment->hasLike($comment) == 0){
            
            $comment->like_comment()->create([
                'user_id' =>  Auth::user()->id,
                'comment_id' => $comment->id,
                'likeable_id' => 1
            ]);
        }

        event(new CommentLikeCreated($comment));
        
        return redirect()->back();
    }

    public function dislike(Comment $comment)
    {
        $this->authorize('like', $comment);

        if($comment->hasLike($comment) == 0){
            $comment->like_comment()->create([
                'user_id' => Auth::user()->id,
                'comment_id' => $comment->id,
                'likeable_id' => -1
            ]);
        }
        event(new CommentLikeCreated($comment));
        
        return redirect()->back();
    }

    public function destroy(Request $request, Comment $comment)
    {
        $request->user()->like_comment()->where('comment_id', $comment->id)->delete();
        
        return redirect()->back();
    }
}
