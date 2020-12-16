@extends('layouts.app')

@section('content')
    <form action="{{route('posts.store')}}" enctype="multipart/form-data" method="post">
        @csrf
        <div class="row mb-3">
            <div class="col col-md-8 offset-md-2">
                <h1>Add new post</h1>
            </div>
        </div>
        <div class="row">
            <div class="col col-md-8 offset-md-2">
                <div class="form-group mb-3">
                    <label for="image">Image</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input @error('image') is-invalid @enderror" id="image" name="image" value="{{ old('image') }}" autocomplete="image" accept="image/*">
                            <label class="custom-file-label" for="image">Choose file</label><br>
                        </div>
                    </div>
                    @error('image')
                    <p class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </p>
                    @enderror
                </div>
                <img src="" alt="" class="w-100 d-none mb-3 rounded" id="image-preview">
            </div>
        </div>
        <div class="row">
            <div class="col col-md-8 offset-md-2">
                <div class="form-group mb-3">
                    <label for="caption">Caption</label>
                    <textarea id="caption" class="form-control @error('caption') is-invalid @enderror" name="caption" value="{{ old('caption') }}" autocomplete="caption" style="min-height: 50px"></textarea>
                    @error('caption')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col col-md-8 offset-md-2">
                <button class="btn btn-primary">Add new post</button>
            </div>
        </div>
    </form>
    <script>
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
				image.classList.remove( 'd-none' );
			};


			fileReader.readAsDataURL( file ); // fileReader.result -> URL.
		} );
    </script>
@endsection