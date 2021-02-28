<?php

namespace App\Models;

use App\Models\Post;
use App\Models\User;
use App\Models\Rating;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Movie extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function post(){
        return $this->hasMany(Post::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function rating(){
        return $this->hasMany(Rating::class);
    }

    public function hasRating(User $user){
        return $this->rating->contains('user_id', $user->id);
    }
    public function numberRating(User $user){
        return $this->rating->where('user_id', $user->id)->first();
    }

    public function allRating(Movie $movie){
        return $this->rating->where('movie_id', $movie->id);
    }

}
