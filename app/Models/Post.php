<?php

namespace App\Models;

use App\Models\User;
use App\Models\Comment;
use App\Models\LikePost;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    
    protected $fillable = ['movie_id', 'user_id', 'content'];

    public function movie(){
        return $this->belongsTo(Movie::class);
    }

    public function comment(){
        return $this->hasMany(Comment::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getFormatDateAttribute(){
        return date('d F Y H:i', \strtotime($this->created_at));
    }

    public function isAuthor(User $user){
        return $this->user_id === $user->id;
    }

    public function like_post(){
        return $this->hasMany(LikePost::class);
    }

    public function likedBy(User $user) {
        return $this->like_post->contains('user_id', $user->id);
    }

    public function hasLike(Post $post){
        return $this->like_post
                ->where('post_id', $post->id)
                ->where('user_id', Auth::user()->id);
    }

    public function countLike(){
        return $this->like_post->where('likeable_id', 1)->count();
    }
    
    public function countDislike(){
        return $this->like_post->where('likeable_id', -1)->count();
    }

    public function hasNotify(Post $post){
        return DatabaseNotification::where('type', 'App\Notifications\NotificationPostLike')
                ->where('data->post->id', $post->id)
                ->where('data->user->id', Auth::user()->id);
    }
}
