@extends('layouts.app')
@section('content')
    
<div class="container">

    <div class="card mt-3">
        <div class="card-body">
            <div class="d-flex">
                <h1>Edytuj profil</h1>
            </div>  

            <div class="row">
                <div class="col-md-4 offset-md-0 col-sm-8 offset-sm-2">
                    <div class="card mt-3">
    
                        <div class="card-body">
                        @if($user->image)
                            <img class="mx-auto d-block" src="{{ Storage::url($user->image) }}" style="max-width: 100%; max-height: 300px;" alt="image">
                            <hr>
                            <button class="btn btn-outline-danger btn-sm btn-block" onclick="deleteImage()">Delete Photo</button>
                            
                            <form action="{{ route('profile.delete', ['user' => $user->id]) }}" method="POST" id="deleteImageForm" style='display: inline;'>    
                                @csrf
                                @method('DELETE')
                            </form>
                        
                        @else
                            <img src="/images.png" style="max-width: 100%, max-height: 200px;" alt="">
                            <hr>
                            <button class="btn btn-outline-primary btn-sm btn-block" data-toggle="modal" data-target="#updateProfileImage">Nowe zdjęcie</button>
                        
                        @endif
                        
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <form action="{{ route('profile.update', ['user' => $user->id]) }}" method='POST'>
                @csrf
                @method('PUT')
        
                <div class="form-group">
                    <label for="">Imię</label>
                <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                </div>
        
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" class="form-control" name="email" value="{{ $user->email }}">
                </div>
                <button class="btn btn-primary float-right">Edytuj dane</button>
            </form>
        </div>
    </div>  
    
</div>

<div class="modal fade" id="updateProfileImage">
    <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Wybierz zdjęcie</h5>
            <button class="btn btn-warning float-right" data-dismiss="modal">X</button>
          </div>
         
          
          <div class="modal-body">
            <form action="{{ route('profile.store', ['user' => Auth::user()->id]) }}" method='POST' enctype="multipart/form-data">
                @csrf
                <input type='file' name='image'>
                <button class="btn btn-primary float-right">Wstaw nowe zdjęcie</button>

            </form>
          </div>
        </div>
    </div>
</div>

@endsection
<script>
    function deleteImage(){
        var choose = confirm('Czy na pewno chcesz usunąć zdjęcie?')
        if(choose){
            document.getElementById('deleteImageForm').submit()
        }
    }
</script>