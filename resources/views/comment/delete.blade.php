<form action ="{{ route('comment.delete', ['comment'=>$comment->id]) }}" style='float:right' method="POST" style='display:inline;'>
    @method('DELETE')
    @csrf
    <button class='btn btn-danger' type='submit'>Delete</button>
</form>