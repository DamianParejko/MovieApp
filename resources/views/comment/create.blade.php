<div class="row justify-content-center" style='margin-top:20px'>
    <div class="col-md-8">
        <div class="media-body u-shadow-v18 g-bg-secondary g-pa-30">
            <div class="g-mb-15">
                <form action="{{ route('comment.store', ['post' => $post->id]) }}" method='POST'>
                    @csrf
                    <div class="form-row">

                        <div class="col-10"> 
                            <input type="text" class="form-control" name='comment' placeholder="Komentarz">
                        </div>

                        <div class="col-2">
                            <button class='btn btn-secondary' type='submit'>Dodaj</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>