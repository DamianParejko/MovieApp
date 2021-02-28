<div class="col-md-4" style='min-width:350px;'>
    @can('rating', $movie)
        <app-rating :movie='{{ $movie->id }}'>
        </app-rating>
    @endcan
    @if(Auth::user())
    @cannot('rating', $movie)
        <div id='app' style='box-shadow: 0 5px 5px 2px black; height: 250px'>
            <div class='sugestion'>
                <p>Twoja ocena to:</p>
            </div>
            <div class="number">
                <p> {{ $movie->numberRating(Auth::user())->rating}}</p>
            </div>
            
            <form action="{{ route('rating.delete', ['rating' => $movie->numberRating(Auth::user())->id ], ) }}" method="POST">
            
                @method('DELETE')
                @csrf
                <br>
                <button class="btn btn-outline-dark btn-sm btn-block justify-content-center" style='width:150px; margin:auto'>
                    Usuń
                </button>

            </form>
        </div>
    @endcannot
    @endif
</div>