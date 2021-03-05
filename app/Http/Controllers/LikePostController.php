<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Jobs\CreateLike;
use App\Jobs\DeleteLike;
use App\Jobs\CreateDislike;

class LikePostController extends Controller
{
    public function like(Post $post){

        $this->authorize('like', $post);

        $this->dispatchNow(new CreateLike($post));
        
        return redirect()->back()->with('message', 'Zareagowałeś na post');
    }

    public function dislike(Post $post){
    
        $this->authorize('like', $post);

        $this->dispatchNow(new CreateDislike($post));   
          
        return redirect()->back()->with('message', 'Zareagowałeś na post');
    }

    public function destroy(Post $post){

        $this->authorize('destroy', $post);

        $this->dispatchNow(new DeleteLike($post));

        return redirect()->back()->with('message', 'Reakcja usunięta');
    }
}
