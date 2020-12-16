@extends('layouts.app')

@section('content')
    @foreach($posts as $post)
        <div class="card mx-auto mb-5" style="width: 600px;">
            <div class="card-header d-flex align-items-center bg-white">
                <a href="{{ route('profiles.show', $post->user->id) }}" class="mr-3" style="width: 32px">
                    <div class="square-image-block">
                        <img src="{{ $post->user->profile->image }}" alt=""
                             class="square-image rounded-circle">
                    </div>
                </a>
                <a href="{{ route('profiles.show', $post->user->id) }}" class="font-weight-bold text-dark mb-0">{{$post->user->username}}</a>
            </div>
            <img src="{{ $post->image }}" class="card-img-top rounded-0" alt="...">
            <div class="card-body">
                <p class="card-text text-dark">
                    <span><a href="{{ route('profiles.show', $post->user->id) }}" class="font-weight-bold text-dark mb-0 mr-2">{{$post->user->username}}</a></span>
                    {{ $post->caption }}
                </p>
            </div>
        </div>
    @endforeach
    <div class="d-flex justify-content-center">
        {{ $posts->links() }}
    </div>
@endsection