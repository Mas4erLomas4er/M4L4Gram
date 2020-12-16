@extends('layouts.app')

@section('content')
    <div class="card mx-auto" id="card">
        <div class="row no-gutters h-100">
            <div class="col-md-7">
                <img src="{{ $post->image }}" class="card-img" id="card-img" alt="...">
            </div>
            <div class="col-md-5 h-100">
                <div class="card-body h-100 overflow-hidden" style="font-size: 0.87rem;">
                    <div class="border-bottom d-flex align-items-center pb-3">
                        <a href="{{ route('profiles.show', $post->user->id) }}" class="mr-3" style="width: 32px">
                            <div class="square-image-block">
                                <img src="{{ $post->user->profile->image }}" alt=""
                                     class="square-image rounded-circle">
                            </div>
                        </a>
                        <div class="">
                            <a href="{{ route('profiles.show', $post->user->id) }}" class="font-weight-bold text-dark mb-0 mr-3">{{$post->user->username}}</a>
                            <button class="btn btn-primary btn-sm">Follow</button>
                        </div>
                    </div>
                    <div class="overflow-auto no-scrollbar" id="card-scrollable" style="height: calc(100% - 50px);">
                        <div class="my-3 d-flex align-items-start">
                            <a href="{{ route('profiles.show', $post->user->id) }}" class="mr-3 d-block" style="width: 32px; min-width: 32px;">
                                <div class="square-image-block">
                                    <img src="{{ $post->user->profile->image }}" alt=""
                                         class="square-image rounded-circle">
                                </div>
                            </a>
                            <div style="line-height: normal">
                                <p class="text-dark">
                                    <span><a href="{{ route('profiles.show', $post->user->id) }}" class="font-weight-bold text-dark mb-0 mr-2">{{$post->user->username}}</a></span>
                                    {{ $post->caption }}
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script>
		window.addEventListener( 'load', function () {
			if ( document.getElementById( 'card-img' ).height > document.getElementById( 'card-img' ).width )
				document.getElementById( 'card' ).style.maxWidth = "900px";
			document.getElementById( 'card' ).style.height = document.getElementById( 'card-img' ).height + 2 + 'px';
			console.log( document.getElementById( 'card-img' ).height );
		});
    </script>
@endsection