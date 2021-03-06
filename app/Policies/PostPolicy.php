<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function delete(User $user, Post $post)
    {
        return $post->isAuthor($user);
    }

    public function edit(User $user, Post $post){
        return $post->isAuthor($user);
    }

    public function like(User $user, Post $post){
        return !$post->isAuthor($user) and !$post->hasLike($post)->count();
    }

    public function destroy(User $user, Post $post){
        return $post->likedBy(Auth::user());
    }

}
