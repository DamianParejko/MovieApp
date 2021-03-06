<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\LikeComment;
use App\Jobs\CreateCommentLike;
use App\Jobs\DeleteCommentLike;
use App\Jobs\CreateCommentDislike;

class LikeCommentController extends Controller
{

    public function like(Comment $comment)
    {
        $this->authorize('like', $comment);
        
        $this->dispatchNow(new CreateCommentLike($comment));
        
        return redirect()->back()->with('message', 'Zareagowałeś na post');
    }

    public function dislike(Comment $comment)
    {
        $this->authorize('like', $comment);

        $this->dispatchNow(new CreateCommentDislike($comment));
        
        return redirect()->back()->with('message', 'Zareagowałeś na post');
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('destroy', $comment);

        $this->dispatchNow(new DeleteCommentLike($comment));
        
        return redirect()->back()->with('message', 'Reakcja usunięta');
    }
}
