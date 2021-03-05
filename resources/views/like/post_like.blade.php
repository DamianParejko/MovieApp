@can('like', $post)
    <a class="btn btn-outline-dark"
        href="{{ route('post.like', ['post' => $post->id]) }}">
        {{$post->countLike() }} - 
        <i class="fa fa-thumbs-up g-pos-rel g-top-1 g-mr-3"></i>
    </a>
@endcan

@cannot('like', $post)
    <a class="btn btn-outline-dark" style='cursor:default'>
        {{$post->countLike() }} - 
        <i class="fa fa-thumbs-up g-pos-rel g-top-1 g-mr-3"></i>
    </a>
@endcan

@can('destroy', $post)
    &nbsp;
    <form action='{{ route('post.like.delete', ['post' => $post->id]) }}' method="POST" style='display:inline;'>
        @csrf
        @method('DELETE')
        <button class='btn btn-secondary' type='submit'>Cofnij</button>
    </form>
@endcan

&nbsp;

@can('like', $post)
    <a class="btn btn-outline-dark" 
        href="{{ route('post.dislike', ['post' => $post->id]) }}">
        <i class="fa fa-thumbs-down g-pos-rel g-top-1 g-mr-3"></i>
        - {{$post->countDislike() }}
    </a>
@endcan

@cannot('like', $post)
    <a class="btn btn-outline-dark" style='cursor:default'>
        <i class="fa fa-thumbs-down g-pos-rel g-top-1 g-mr-3"></i>
        - {{$post->countDislike() }}
    </a>
@endcan