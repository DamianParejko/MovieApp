<a class="btn btn-outline-dark" style='cursor:default;'>
    {{$comment->countLikeComment() }} - 
<i class="fa fa-thumbs-up g-pos-rel g-top-1 g-mr-3"></i>
</a>

&nbsp;

<a class="btn btn-outline-dark" style='cursor:default;'>
<i class="fa fa-thumbs-down g-pos-rel g-top-1 g-mr-3"></i>
 -  {{$comment->countDislikeComment() }}
</a>
