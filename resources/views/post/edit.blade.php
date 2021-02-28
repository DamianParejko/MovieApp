@extends('layouts.app')

@section('content')

<div class="container">
    @if($errors->count())
        @foreach ($errors->all() as $error)
            <div class='alert alert-danger'>
                <li> {{ $error }} </li>
            </div>
        @endforeach
    @endif
    <div class="media g-mb-30 media-comment">
        <img class="d-flex g-width-50 g-height-50 rounded-circle g-mt-3 g-mr-15" src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Image">
        <div class="media-body u-shadow-v18 g-bg-secondary g-pa-30">
            <div class="g-mb-15">
                <h5 class="h5 g-color-gray-dark-v1 mb-0">{{ $post->user->name  }}</h5>
                    <span class="g-color-gray-dark-v4 g-font-size-12">{{ $post->formatDate }}</span>
            </div>
            <form action="{{ route('post.update', ['post' => $post->id]) }}" method='POST'>
                @method('PUT')
                @csrf
                <div>
                    <input class='card-footer' style='margin-bottom:5px;border-radius:5px;' name='content' value="{{ $post->content }}">
                </div>
                <button class='btn btn-secondary' type='submit'>Zapisz</button>
                <a href="{{ route('movie.show', ['movie'=>$post->movie_id]) }}" class='btn btn-primary'>Nie zapisuj</a>
            </form> 
        </div>
    </div>
</div>


@endsection