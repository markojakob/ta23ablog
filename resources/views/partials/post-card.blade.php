<div class="card bg-base-300 shadow-sm">
    {{-- <figure>
            <img src="https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.webp"
                alt="Shoes" />
        </figure> --}}
    <div class="card-body">
        <h2 class="card-title">{{ $post->title }}</h2>
        @isset($full)
            <p>{!! $post->displayBody !!}</p>
        @else
            <p>{{ $post->snippet }}</p>
        @endisset
        <p class="text-base-content/50">{{ $post->user->name }}</p>
        <p class="text-base-content/50">{{ $post->created_at->diffForHumans() }}</p>
        <p class="text-base-content/50"><b>Comments: </b>{{ $post->comments_count }}</p>
        <p class="text-base-content/50"><b>Likes: </b>{{ $post->likes_count }}</p>
        <p>
            <a href="{{ route('category', ['category' => $post->category]) }}">
                <div class="badge badge-secondary">{{ $post->category->name }}</div>
            </a>
        </p>
        <div class="flex flex-row flex-wrap gap-1">
            @foreach($post->tags as $tag)
                <div class="badge badge-primary">{{ $tag->name }}</div>
            @endforeach
        </div>
        <div class="card-actions justify-end">
            @if($post->authHasLiked)
                <a href="{{route('like', $post)}}" class="btn btn-error">Unlike</a>
            @else
                <a href="{{route('like', $post)}}" class="btn btn-secondary">Like</a>
            @endif
            @if(!isset($full))
                <a href="{{route('post', $post)}}" class="btn btn-primary">Read More</a>
            @endif
        </div>
    </div>
</div>
