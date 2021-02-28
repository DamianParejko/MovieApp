@extends('layouts.app')

@section('movie')

<div class="nav-link" style='font-size:22px; margin: 0 auto; min-width:180px;'>
  <i class="fa fa-reply g-pos-rel g-top-1 g-mr-3"></i>

  <a href="{{route('movie.show', ['movie' => $post->movie_id])}}" style='color: black;'>  
    {{ $post->movie->title }}
  </a>

</div>

@endsection

@section('content')
<div class='container'>
  
  @if($errors->count())
  @foreach ($errors->all() as $error)
      <div class='alert alert-danger'>
          <li> {{ $error }} </li>
      </div>
  @endforeach
  @endif

    <div class="row">
        @include('post.post')
    </div>

    <div class='row justify-content-end'>
      @foreach ($comments as $comment)
        @include('comment.comment')
      @endforeach
    </div>

    @include('comment.create')

    <br>
    <div class="d-flex">
        <div class="mx-auto">
            {{$comments->links("pagination::bootstrap-4")}}
        </div>
    </div>
</div>    

@endsection


