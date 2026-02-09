@extends('partials.layout')
@section('title', 'Tags')

@section('content')
<div class="mb-4 flex gap-2">
    <a href="{{ route('tags.create') }}" class="btn btn-primary">New Tag</a>
    @if(Route::is('tags.deleted'))
        <a href="{{ route('tags.index') }}" class="btn btn-secondary">All Tags</a>
    @else
        <a href="{{ route('tags.deleted') }}" class="btn btn-secondary">Deleted Tags</a>
    @endif
</div>

{{ $tags->links() }}

<div class="bg-base-100 border border-base-content/5 rounded-box">
    <table class="table table-zebra w-full">
        <thead>
            <th>ID</th>
            <th>Name</th>
            <th>Actions</th>
        </thead>
        <tbody>
            @foreach($tags as $tag)
                <tr class="hover:bg-base-300">
                    <td>{{ $tag->id }}</td>
                    <td>{{ $tag->name }}</td>
                    <td>
                        <div class="join">
                            @if($tag->trashed())
                                <form action="{{ route('tags.restore', $tag) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn join-item btn-success">Restore</button>
                                </form>
                                <form action="{{ route('tags.permadestroy', $tag) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn join-item btn-error">Perma Delete</button>
                                </form>
                            @else
                                <a href="{{ route('tags.edit', $tag) }}" class="btn join-item btn-warning">Edit</a>
                                <form action="{{ route('tags.destroy', $tag) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn join-item btn-error">Delete</button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <th>ID</th>
            <th>Name</th>
            <th>Actions</th>
        </tfoot>
    </table>
</div>

{{ $tags->links() }}
@endsection
