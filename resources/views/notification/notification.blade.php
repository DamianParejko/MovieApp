@if (Auth::user())
<li class='nav-item dropdown' id='markasread' onclick="btn('{{ count(Auth::user()->unreadNotifications)}}')">
    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
        Powiadomienia
        @if(count(Auth::user()->unreadNotifications))
            <span> {{ count(Auth::user()->unreadNotifications)}} </span>
        @endif
    </a>
        <ul class="dropdown-menu dropdown-menu-right" role='menu'>
    
                @forelse (Auth::user()->unreadNotifications as $notif)

                    @if($notif->type == 'App\Notifications\NotificationComment')

                    <a class='dropdown-item' href="{{ route('post.show', $notif->data['post']['id']) }}">
                        <u><b>{{ $notif->data['user']['name'] }}</b></u> skomentował post '<i>{{ \Str::limit($notif->data['post']['content'], 25) }}</i>'
                    </a>

                    @elseif($notif->type == 'App\Notifications\NotificationPostLike')
                    <a class='dropdown-item' href="{{ route('post.show', $notif->data['post']['id']) }}"> 
                        <u><b>{{ $notif->data['user']['name'] }}</b></u> zareagował na post: '<i>{{ \Str::limit($notif->data['post']['content'], 25) }}</i>'
                    </a> 

                    @elseif($notif->type == 'App\Notifications\NotificationCommentLike')
                    <a class='dropdown-item' href="{{ route('post.show', $notif->data['comment']['post_id']) }}">    
                        <u><b>{{ $notif->data['user']['name'] }}</b></u> zareagował na komentarz: '<i>{{ \Str::limit($notif->data['comment']['comment'], 25) }}<i>'
                    </a>
                    @endif

                @empty
                    <li class='dropdown-item'> brak powiadomień</li>
                @endforelse
            
        </ul>
        
</li>
@endif