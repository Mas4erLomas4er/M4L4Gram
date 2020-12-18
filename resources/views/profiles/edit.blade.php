@extends('layouts.app')

@section('content')
    <form action="{{route('profiles.update', $user->id)}}" enctype="multipart/form-data" method="post">
        @csrf
        @method('PATCH')
        <div class="row mb-3">
            <div class="col col-md-8  m-auto m-auto">
                <h1>Edit profile</h1>
            </div>
        </div>
        <div class="row">
            <div class="col col-md-8  m-auto m-auto">
                <div class="form-group mb-3">
                    <label for="username">Username</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label for="username" class="input-group-text">@</label>
                        </div>
                        <input id="username"
                               class="form-control @error('username') is-invalid @enderror"
                               name="username"
                               value="{{ old('username') ?? $user->username}}"
                               autocomplete="username"
                               autofocus>
                    </div>
                    @error('username')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col col-md-8  m-auto">
                <div class="form-group mb-3">
                    <label for="name">Name</label>
                    <input id="name"
                           class="form-control @error('name') is-invalid @enderror"
                           name="name"
                           value="{{ old('name') ?? $user->name }}"
                           autocomplete="name">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col col-md-8  m-auto">
                <div class="form-group mb-3">
                    <label for="bio">Biography</label>
                    <input id="bio"
                           class="form-control @error('bio') is-invalid @enderror"
                           name="bio"
                           value="{{ old('bio') ?? $user->profile->bio }}"
                           autocomplete="bio">
                    @error('bio')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col col-md-8  m-auto">
                <div class="form-group mb-3">
                    <label for="site">Site</label>
                    <input id="site"
                           class="form-control @error('site') is-invalid @enderror"
                           name="site"
                           value="{{ old('site') ?? $user->profile->site }}"
                           autocomplete="site">
                    @error('site')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col col-md-8 m-auto mb-3">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-3 pl-0">
                            <div class="square-image-block">
                                <img src="{{ $user->profile->image }}" alt="" class="square-image mb-3 rounded-circle" id="image-preview">
                            </div>
                        </div>
                        <div class="form-group col-9 pr-0">
                            <label for="image">Image</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file"
                                           class="custom-file-input @error('image') is-invalid @enderror"
                                           id="image"
                                           name="image"
                                           value="{{ old('image') }}"
                                           autocomplete="image"
                                           accept="image/*">
                                    <label class="custom-file-label" for="image">Choose file</label><br>
                                </div>
                            </div>
                            @error('image')
                            <p class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col col-md-8  m-auto offset-md-2">
                <button class="btn btn-primary">Edit</button>
            </div>
        </div>
    </form>
    <script>
		window.onload = function () {
			let imageFile = document.getElementById( 'image' );
			imageFile.addEventListener( 'change', function ( event ) {
				event.stopPropagation();
				event.preventDefault();
				let file = event.target.files[ 0 ];
				let fileReader = new FileReader();

				fileReader.onload = function ( progressEvent ) {
					let url = fileReader.result;
					let image = document.getElementById( 'image-preview' );
					image.src = url;
					image.parentElement.classList.remove( 'd-none' );
				};


				fileReader.readAsDataURL( file );
			} );
		}
    </script>
@endsection
