<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Comment;
use App\Models\LikeComment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    public function edit(User $user, Comment $comment){
        return $comment->isAuthor($user);
    }

    public function delete(User $user, Comment $comment){
        return $comment->isAuthor($user);
    }

    public function like(User $user, Comment $comment){
        return !$comment->isAuthor($user) && !$comment->hasLike($comment)->count();
    }

    public function destroy(User $user, Comment $comment){
        return $comment->likedBy(Auth::user());
    }
}
