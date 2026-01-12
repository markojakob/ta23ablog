<li>
    <details>
        <summary>{{$category->name}}</summary>
        <ul class="p-2">
            @foreach ($category->children as $child)
                @if($child->children->count() > 0)
                    @include('partials.submenu', ['category' => $child])
                @else
                     <li><a href="{{ route('category', ['category' => $child]) }}">{{$child->name}}</a></li>
                @endif
            @endforeach
        </ul>
    </details>
</li>
