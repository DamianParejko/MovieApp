<div class="col-md-8">
    <div class="media g-mb-30 media-comment">
        @if($post->user->image)
            <img class="d-flex g-width-50 g-height-50 rounded-circle g-mt-3 g-mr-15" src="{{Storage::url($post->user->image) }}" alt="Image">
        @else
            <img class="d-flex g-width-50 g-height-50 rounded-circle g-mt-3 g-mr-15" src="/anong.png" alt="Image" style='border: 1px solid grey;'>
        @endif
        <div class="media-body u-shadow-v18 g-bg-secondary g-pa-30">
            <div class="g-mb-15">
                                
            @can('delete', $post)
                @include('post.delete')
            @endcan

            @can('edit', $post)
                <a href="{{ route('post.edit', ['post' => $post->id])}}" class='btn btn-warning' style="float:right;">Edytuj</a>
            @endcan

            <h5 class="h5 g-color-gray-dark-v1 mb-0">{{ $post->user->name  }}</h5>
                <span class="g-color-gray-dark-v4 g-font-size-12">{{ $post->formatDate }}</span>
            </div>
            <div class='card-footer' style='margin-bottom:5px;border-radius:5px;'>
                <p style="max-width: 45vw">{{ $post->content }}</p>
            </div>
            <ul class="list-inline d-sm-flex my-0">
            
            @can('like', $post)
            @if(!$post->likedBy(Auth::user()))
                @include('like.post_like')
            @else
                @include('like.post_deletelike')
            @endif          
            @endcan

            @cannot('like', $post)
                @include('like.count_like')
            @endcannot

            <li class="list-inline-item ml-auto">
                <a class="u-link-v5 g-color-gray-dark-v4 g-color-primary--hover" href="{{ route('post.show', ['post'=>$post->id]) }}">
                <i class="fa fa-reply g-pos-rel g-top-1 g-mr-3"></i>
                Skomentuj
                </a>
            </li>
            </ul>  
        </div>
    </div>
</div>