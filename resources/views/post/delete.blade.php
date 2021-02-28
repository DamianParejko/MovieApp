<form action='{{ route('post.delete', ['post' => $post->id]) }}' method="POST" style='display:inline;'>
    @csrf
    @method('DELETE')
    <button class='btn btn-danger' type='submit' style='float:right'>Usuń</button>
</form>

