@can('like', $comment)
    <a class="btn btn-outline-dark"
        href="{{ route('comment.like', ['comment' => $comment->id]) }}">
        {{$comment->countLikeComment() }} - 
        <i class="fa fa-thumbs-up g-pos-rel g-top-1 g-mr-3"></i>
    </a>
@endcan

@cannot('like', $comment)
    <a class="btn btn-outline-dark" style='cursor:default;'>
        {{$comment->countLikeComment() }} - 
        <i class="fa fa-thumbs-up g-pos-rel g-top-1 g-mr-3"></i>
    </a>    
@endcannot

@can('destroy', $comment)
    &nbsp;

    <form action='{{ route('comment.like.delete', ['comment' => $comment->id]) }}' method="POST" style='display:inline;'>
        @csrf
        @method('DELETE')
        <button class='btn btn-secondary' type='submit'>Cofnij</button>
    </form>

@endcan

&nbsp;

@can('like', $comment)
    <a class="btn btn-outline-dark" 
        href="{{ route('comment.dislike', ['comment' => $comment->id]) }}">
        <i class="fa fa-thumbs-down g-pos-rel g-top-1 g-mr-3"></i>
        - {{$comment->countDislikeComment() }}
    </a>
@endcan

@cannot('like', $comment)
    <a class="btn btn-outline-dark" style='cursor:default;'>
    <i class="fa fa-thumbs-down g-pos-rel g-top-1 g-mr-3"></i>
     - {{$comment->countDislikeComment() }}
    </a>
@endcannot
    
