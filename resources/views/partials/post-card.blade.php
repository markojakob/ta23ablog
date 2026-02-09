<div class="card bg-base-300 shadow-sm">
    @if ($post->images->count() === 1)
        <figure>
            <img src="{{ $post->images->first()->url }}" alt="Shoes" />
        </figure>
    @elseif($post->images->count() > 1)
        <div class="carousel rounded-box ">
            @foreach($post->images as $image)
                <div class="carousel-item  w-full">
                    <img src="{{$image->url}}"  />
                </div>
            @endforeach
        </div>
    @endif
    <div class="card-body">
        <h2 class="card-title">{{ $post->title }}</h2>
        @isset($full)
            <p>{!! $post->displayBody !!}</p>
        @else
            <p>{{ $post->snippet }}</p>
        @endisset
        <p class="text-base-content/50"><a href="{{ route('user', $post->user) }}">{{ $post->user->name }}</a></p>
        <p class="text-base-content/50">{{ $post->created_at->diffForHumans() }}</p>
        <p class="text-base-content/50"><b>Comments: </b>{{ $post->comments_count }}</p>
        <p class="text-base-content/50"><b>Likes: </b>{{ $post->likes_count }}</p>
        <p>
            <a href="{{ route('category', ['category' => $post->category]) }}">
                <div class="badge badge-secondary">{{ $post->category->name }}</div>
            </a>
        </p>
        <div class="flex flex-row flex-wrap gap-1">
    @foreach ($post->tags as $tag)
        <a href="{{ route('tag', $tag) }}">
            <div class="badge badge-primary">{{ $tag->name }}</div>
        </a>
    @endforeach
</div>
        <div class="card-actions justify-end">
            @if ($post->authHasLiked)
                <a href="{{ route('like', $post) }}" class="btn btn-error">Unlike</a>
            @else
                <a href="{{ route('like', $post) }}" class="btn btn-secondary">Like</a>
            @endif
            @if (!isset($full))
                <a href="{{ route('post', $post) }}" class="btn btn-primary">Read More</a>
            @endif
        </div>
    </div>
</div>
