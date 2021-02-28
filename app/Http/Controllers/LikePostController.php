<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Events\PostLikeCreated;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NotificationPostLike;

class LikePostController extends Controller
{
    public function like(Post $post){

        $this->authorize('like', $post);

        if($post->hasLike($post) == 0){
            $post->like_post()->create([
                'user_id' => Auth::user()->id,
                'post_id' => $post->id,
                'likeable_id' => 1
            ]);  
        }
        
        event(new PostLikeCreated($post));
   
        return redirect()->back()->with('message', 'Zareagowałeś na post');
    }

    public function dislike(Post $post){
    
        $this->authorize('like', $post);
        
        if($post->hasLike($post) == 0){
            $post->like_post()->create([
                'user_id' => Auth::user()->id,
                'post_id' => $post->id,
                'likeable_id' => -1
            ]);
        }
       
        event(new PostLikeCreated($post));     
          
        return redirect()->back()->with('message', 'Zareagowałeś na post');
    }

    public function destroy(Post $post, Request $request){

        $notification = DB::table('notifications')
            ->where('data->post->id', $post->id)
            ->where('data->user->id', Auth::user()->id);

        $notification->delete();

        $request->user()->like_post()->where('post_id', $post->id)->delete();

        return redirect()->back()->with('message', 'Reakcja usunięta');
    }
}
