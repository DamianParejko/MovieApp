<div class="col-md-8">
  <div class="media g-mb-30 media-comment">
      <div class="media-body u-shadow-v18 g-bg-secondary g-pa-30" style='margin-right:20px;'>
        <div class="g-mb-15">
          @can('delete', $comment)
            @include('comment.delete')
          @endcan
          @can('edit', $comment)
            <a href="{{ route('comment.edit', ['comment' => $comment->id]) }}" class='btn btn-warning' style='float:right'>Edit</a>
          @endcan
                            
          <h5 class="h5 g-color-gray-dark-v1 mb-0">{{ $comment->user->name  }}</h5>
            <span class="g-color-gray-dark-v4 g-font-size-12">{{ $comment->formatDate }}</span>
          </div>
          <div class='card-footer' style='margin-bottom:5px;border-radius:5px;'>
            <p style="max-width: 45vw">{{ $comment->comment }}</p>
          </div>
          <ul class="list-inline d-sm-flex my-0">
     
              @include('like.comment_like')

        </ul>  
      </div>
      @if($comment->user->image)
      <img class="d-flex g-width-50 g-height-50 rounded-circle g-mt-3 g-mr-15" src="{{Storage::url($comment->user->image) }}" alt="Image" >
    @else
      <img class="d-flex g-width-50 g-height-50 rounded-circle g-mt-3 g-mr-15" src="/anong.png" alt="Image" style='border: 1px solid grey;'>
    @endif
  </div>
</div>