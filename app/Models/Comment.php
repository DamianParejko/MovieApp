<?php

namespace App\Models;

use App\Models\Post;
use App\Models\LikeComment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;
    
    protected $fillable = ['comment', 'user_id', 'post_id'];

    public function post(){
        return $this->belongsTo(Post::class);
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

    public function like_comment(){
        return $this->hasMany(LikeComment::class);
    }

    public function likedBy(User $user) {
        return $this->like_comment->contains('user_id', $user->id);
    }

    public function hasLike(Comment $comment){
        return $this->like_comment
            ->where('comment_id', $comment->id)
            ->where('user_id', Auth::user()->id);
    }

    public function commentLikeBy(User $user){
        return $this->like_comment->contains('user_id', $user->id);
    }

    public function countLikeComment(){
        return $this->like_comment->where('likeable_id', 1)->count();
    }

    public function countDislikeComment(){
        return $this->like_comment->where('likeable_id', -1)->count();
    }

    public function hasNotify(Comment $comment){
        return DatabaseNotification::where('data->id', $comment->id);
    }

    public function hasNotifyLike(Comment $comment){
        return DatabaseNotification::where('type', 'App\Notifications\NotificationCommentLike')
            ->where('data->comment->id', $comment->id)
            ->where('data->user->id', Auth::user()->id);
    }
}
