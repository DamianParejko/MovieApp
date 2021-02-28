<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Movie;
use App\Models\Rating;
use DivisionByZeroError;
use Illuminate\Http\Request;
use App\Http\Requests\RatingRequest;
use Illuminate\Support\Facades\Auth;

class MovieController extends Controller
{
    public function __construct(){

    }
    
    public function index(){

        $lates = Movie::orderBy('created_at', 'desc')->limit(3)->get();
        $movies = Movie::all();

        return view('movie.index', compact('lates', 'movies'));
    }

    public function show(Movie $movie){
        
        $posts = Post::where('movie_id', $movie->id)
                ->orderBy('created_at', 'desc')
                ->paginate(4);
        
        $avg = $movie->allRating($movie)->avg('rating');  
        $count = $movie->allRating($movie)->count();     
        
        return view('movie.show', \compact('movie', 'posts', 'avg', 'count'));    
    }


    public function selectRating(Request $request, Movie $movie){

        $this->authorize('rating', $movie);

        Rating::create([
            'user_id' => Auth::user()->id,
            'movie_id' => $movie->id,
            'rating' => $request->rating,
        ]);
        return response()->json(201);
    }

    public function deleteRating(Request $request, Rating $rating){
        
        $rating->delete();

        return redirect()->back();
    }
}
