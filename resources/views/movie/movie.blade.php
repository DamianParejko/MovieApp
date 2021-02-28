<div class="row">
    <div class="col-md-8">
        <div class="row g-0">
            <div class="col-lg-4 col-md-5 col-sm-5">
                <img src="{{URL::asset('/image/'. $movie->title . '.jpeg' )}}">
            </div>
            <div class="col-lg-8 col-md-7 col-sm-7">
                <div class="card-body">
                <h5 class="card-title">{{ $movie->title }} </h5> 
                    <p class="card-text ">{{ $movie->description }}</p>

                    <div class="row">
                        <div class="col-4 col-lg-4 col-md-6 col-sm-5"><small class="text-muted">Reżyseria:</small></div>
                        <div class="col-8 col-lg-8 col-md-6 col-sm-7">{{ $movie->director }}</div>
                    </div>
                    <div class="row">
                        <div class="col-4 col-lg-4 col-md-6 col-sm-5"><small class="text-muted">Kategoria:</small></div>
                        <div class="col-8 col-lg-8 col-md-6 col-sm-7">{{ $movie->category }}</div>
                    </div>
                    <div class="row">
                        <div class="col-4 col-lg-4 col-md-6 col-sm-5"><small class="text-muted">Rok produkcji:</small></div>
                        <div class="col-8 col-lg-8 col-md-6 col-sm-7">{{ $movie->year }}</div>
                    </div>
                    <div class="row">
                        <div class="col-4 col-lg-4 col-md-6 col-sm-5"><small class="text-muted">Długość:</small></div>
                        <div class="col-8 col-lg-4 col-md-6 col-sm-7">{{ $movie->time }}</div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-4 col-lg-4 col-md-6 col-sm-5"><small>Ocena użytkowników:</small></div>
                        <div class="col-8 col-lg-4 col-md-6 col-sm-7"><i class="fa fa-star" style='color:gold'></i> {{ round($avg, 2) }} <small  class="text-muted">({{$count}})</small>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>