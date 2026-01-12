@extends('partials.layout')
@section('title', 'Home')
@section('content')
    <div class="card bg-base-300">
        <div class="card-body">
            <h1 class="card-title">{{ $user->name }}</h1>
            <p class="text-base-content">
                <b>Comments: </b>{{ $user->comments()->count() }}
            </p>
            <p class="text-base-content">
                <b>Likes made: </b>{{ $user->likes()->count() }}
            </p>
            <p class="text-base-content">
                <b>Likes on users posts: </b>{{ $user->likesOnPosts()->count() }}
            </p>
            @if($user->id !== Auth::user()->id)
                @if ($user->authHasFollowed )
                    <a href="{{ route('follow', $user) }}" class="btn btn-error">Unfollow</a>
                @else
                    <a href="{{ route('follow', $user) }}" class="btn btn-primary">Follow</a>
                @endif
            @endif
            <h1 class="text-3xl">Followers: </h1>
            <div class="flex flex-row flex-wrap gap-1">
                @foreach ($user->followers as $follower)
                    <a href="{{ route('user', $follower) }}">
                        <div class="badge badge-primary">{{ $follower->name }}</div>
                    </a>
                @endforeach
            </div>
            <h1 class="text-3xl">Followees: </h1>
            <div class="flex flex-row flex-wrap gap-1">
                @foreach ($user->followees as $followee)
                    <a href="{{ route('user', $followee) }}">
                        <div class="badge badge-primary">{{ $followee->name }}</div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
    {{ $posts->links() }}
    <div class="grid grid-cols-4 gap-2">
        @foreach ($posts as $post)
            @include('partials.post-card')
        @endforeach
    </div>
@endsection
