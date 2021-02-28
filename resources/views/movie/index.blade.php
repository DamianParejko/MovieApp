@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
      @foreach ($lates as $late)
  
        <div class="col-12 col-sm-6 col-md-4  hover-overlay" >
          <div class="card" data-mdb-ripple-color="light">
            <div class="card-body">
              <h5 class="card-title" style='height:40px' >{{ $late->title }}</h5>
              
              <i>
                <p class="card-text" style='height:40px'> <span>{{ $late->director }} - {{ $late->category }}  {{ $late->year }}<span> <p>
              </i>
                <a href="{{ route('movie.show', ['movie' => $late->id]) }}" class="btn btn-primary">Zobacz więcej</a>
            </div>
          </div>
        </div>
        @endforeach
    </div>

    <div class="row mt-5">
      <div class='col-sm-12'>
        <nav class="navbar navbar-dark bg-dark text-light" style="height: 84px;border-radius: 25px;">
          <h2 style='margin: 0 auto;'>Wszystkie filmy</h2>
        </nav>
      </div>
    </div>
    <div class="row mt-5">
      @foreach ($movies as $movie)
     
        <div class="card-group col-6 col-md-2">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title" style='min-height:80px'>{{ $movie->title }}</h5>
                <div class='card-footer'>
                <i>
                  <p class='card-text' style='height:150px' > {{ $movie->director }} - {{ $movie->category }}  {{ $movie->year }}<p>
                </i>
                <a href="{{ route('movie.show', ['movie' => $movie->id]) }}" class="btn btn-primary">Zobacz więcej</a>
                </div>
            </div>
          </div>
        </div>
        @endforeach
    </div>

</div>


@endsection
