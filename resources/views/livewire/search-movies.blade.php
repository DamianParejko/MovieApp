<div class="input-group col-lg-3">
        <input wire:model.debounce.500ms='search' type="text" class="form-control" placeholder="Search movie">
       
        <div class="input-group-append">
            @if($search == '')
            <button class="btn btn-secondary" type="button"  style='width:40px'>
                <i class="fa fa-search"></i>
            </button>
            @else
                <button wire:click="$set('search', '')" class="btn btn-secondary" type="button" style='width:40px'>    
                    <i class="fas fa-times"></i>
                </button>
            @endif
            </div>
        
        <div class='form-group' style="margin-top:40px; position:absolute; z-index: 8;">
            @if(count($searchResult))
            @foreach($searchResult as $s)               
                <a class="list-group-item"  href="{{ route('movie.show', ['movie' => $s->id ]) }}" style='color: black; border-radius:5px;'>
                    {{ $s->title }}
                </a>
            @endforeach
            @elseif($search != '')
            <a class="list-group-item" style='color: black; border-radius:5px;'>
                Nie znaleziono
            </a>
            @endif


    </div> 
</div>
