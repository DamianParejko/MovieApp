<?php

namespace App\Http\Livewire;

use App\Models\Movie;
use Livewire\Component;
use Illuminate\Http\Request;

class SearchMovies extends Component
{
    public $search = '';

    public function render(Request $request)
    {
        $searchResult = [];
        $search = $this->search;
        
        if( $search != ''){
            $searchResult = Movie::where('title', 'like', $this->search.'%')->select(['title', 'id'])->get();
            if($request->input('reset')){
                $this->search = '';
            };
        }

        

       
        return view('livewire.search-movies', compact('searchResult', 'search'));
    }
}
