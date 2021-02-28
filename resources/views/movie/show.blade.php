@extends('layouts.app')

@section('content')

<div class="container">

    @if($message=Session::get('message'))
      <div class='alert alert-success'> {{ $message }}</div>
    @endif
    
    @include('movie.movie')
        
    @include('rating')

</div>
  
<hr style='margin-top:70px;'>
    <h1 style='text-align:center;'>Komentarze</h1>
<hr>

@if($errors->count())
    @foreach ($errors->all() as $error)
        <div class='alert alert-danger'>
            <li> {{ $error }} </li>
        </div>
    @endforeach
@endif
<div class="row" style='margin-top:20px'>
      @foreach($posts as $post)
          @include('post.post')
      @endforeach
</div>

<hr>
@include('post.create')

<br>
<div class="d-flex">
    <div class="mx-auto">
        {{$posts->links("pagination::bootstrap-4")}}
    </div>
</div>

@endsection


