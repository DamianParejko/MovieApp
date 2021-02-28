<?php

namespace App\Models;

use App\Models\Post;
use App\Models\Rating;
use App\Models\Comment;
use App\Models\LikePost;
use App\Models\LikeComment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function yourProfile(){
        return $this->id === Auth::user()->id;
    }

    public function post(){
        return $this->hasMany(Post::class);
    }

    public function like_post(){
        return $this->hasMany(LikePost::class);
    }
    
    public function comment(){
        return $this->hasMany(Comment::class);
    }
    
    public function like_comment(){
        return $this->hasMany(LikeComment::class);
    }
    
    public function rating(){
        return $this->hasMany(Rating::class);
    }
}
