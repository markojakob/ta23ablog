@extends('partials.layout')
@section('title', 'Posts')
@section('content')
<a href="{{ route('posts.create') }}" class="btn btn-primary">New Post</a>
{{ $posts->links() }}
<div class="bg-base-100 border border-base-content/5 rounded-box">
    <table class="table table-zebra">
        <thead>
            <th>ID</th>
            <th>Title</th>
            <th>Created</th>
            <th>Update</th>
            <th>Actions</th>
        </thead>
        <tbody>
            @foreach($posts as $post)
                <tr class="hover:bg-base-300">
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->created_at }}</td>
                    <td>{{ $post->updated_at }}</td>
                    <td>
                        <div class="join">
                            <a class="btn join-item btn-info">View</a>
                            <a href="{{ route('posts.edit', $post) }}" class="btn join-item btn-warning">Edit</a>
                            <form action="{{ route('posts.destroy', $post)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn join-item btn-error">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <th>ID</th>
            <th>Title</th>
            <th>Created</th>
            <th>Update</th>
            <th>Actions</th>
        </tfoot>
    </table>
</div>
{{ $posts->links() }}
@endsection
