<a class="btn btn-outline-dark">
    {{$comment->countLikeComment() }} - 
    <i class="fa fa-thumbs-up g-pos-rel g-top-1 g-mr-3"></i>
</a>

&nbsp;

<form action='{{ route('comment.like.delete', ['comment' => $comment->id]) }}' method="POST" style='display:inline;'>
    @csrf
    @method('DELETE')
    <button class='btn btn-secondary' type='submit'>Cofnij</button>
</form>

&nbsp;

<a class="btn btn-outline-dark" >
    <i class="fa fa-thumbs-down g-pos-rel g-top-1 g-mr-3"></i>
     -  {{$comment->countDislikeComment() }}
</a>
