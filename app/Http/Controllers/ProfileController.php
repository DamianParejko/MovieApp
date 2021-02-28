<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\Authenticate;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{

    function __construct(){
        $this->middleware([Authenticate::class]);
    }

    function show(User $user){
        if($user->yourProfile($user)){
            return view('profile', compact('user'));
        }
        else {
            return redirect()->route('profile', ['user' => Auth::user()->id]);
        };  
    }

    function store(ProfileRequest $request, User $user){
        if($user->yourProfile($user)){
            if($request->hasFile('image')){
                $path = $request->image->store('public/profile/image');
                $user->update(['image' => $path]);
        }}

        return redirect()->route('profile', ['user' => $user->id]);
    }

    function update(Request $request, User $user){

        if($user->yourProfile($user)){
            $user->update($request->only(['name']));
            }
        else {
            return redirect()->route('profile', ['user' => $user->id]);
            };
       
    }

    function destroy(Request $request, User $user){
        
        if($user->image){
            Storage::delete($user->image);
            $user->update(['image' => null]);
        };

        return redirect()->route('profile', ['user' => $user->id]);
    }
}
