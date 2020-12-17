@extends('layouts.app')

@section('content')
    <div class="row mt-3 mb-5 pb-5 border-bottom">
        <div class="col-4 d-flex justify-content-center">
            <div class="w-100 w-sm-75 w-md-50">
                <div class="square-image-block">
                    <img src="{{ $user->profile->image }}" alt=""
                         class="rounded-circle square-image">
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="mb-4 d-flex flex-column flex-sm-row justify-content-sm-start">
                <h2 class="mb-3 mb-sm-0 mr-sm-4">{{$user->username}}</h2>
                @guest
                    <follow-button user-id="{{ $user->id }}" follows="{{ $follows }}"></follow-button>
                @elseif($user->id == Auth::user()->id)
                    <div class="d-flex">
                        <a class="btn btn-outline-dark px-3 px-sm-4 mr-2 mr-sm-4" href="{{ route('profiles.edit', $user->id) }}"><b>Edit profile</b></a>
                        <a class="btn btn-primary px-3" href="{{route('posts.create')}}"><b>Add post</b></a>
                    </div>
                @else
                    <follow-button user-id="{{ $user->id }}" follows="{{ $follows }}"></follow-button>
                @endguest
            </div>
            <div class="d-flex">
                <div class="mr-5"><b>{{ $stats['posts_count'] }}</b> post</div>
                <div class="mr-5"><b>{{ $stats['followers_count'] }}</b> followers</div>
                <div><b>{{ $stats['followees_count'] }}</b> following</div>
            </div>
            <div class="mt-4 font-weight-bold">{{$user->name}}</div>
            <div>{{$user->profile->bio ?? ""}}</div>
            <div><a href="{{$user->profile->site ?? ""}}" class="text-decoration-none font-weight-bold">{{$user->profile->site ?? ""}}</a></div>
        </div>
    </div>
    <div class="row">
        @if($user->posts->count() == 0)
            <div class="col text-center">
                <h3 class="">No posts yet</h3>
            </div>
        @endif
        @foreach($user->posts as $post)
            <div class="col-4 p-1 p-sm-2">
                <a href="{{ route('posts.show', $post->id) }}">
                    <div class="square-image-block">
                        <img src="{{ $post->image }}" alt="" class="square-image rounded">
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endsection
