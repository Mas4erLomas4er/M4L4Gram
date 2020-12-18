@extends('layouts.app')

@section('content')
    <div class="mx-auto" style="max-width: 600px;width: 100%;">
        <h1>Latest posts</h1>
        @foreach($posts as $post)
            <div class="card mb-5">
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
        @if ($pagination_info->current_page == $pagination_info->last_page)
            <div class="jumbotron my-5 p-5 text-center">
                <h3>You have seen all posts from last 3 days</h3>
            </div>
        @endif
        <div class="d-flex justify-content-center">
            {{ $posts->links() }}
        </div>
    </div>
@endsection
