@extends('partials.layout')
@section('title', 'Edit Tag')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">Edit Tag</h1>

    @if(session('success'))
        <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif

    <form action="{{ route('tags.update', $tag) }}" method="POST">
        @csrf
        @method('PUT')
        <fieldset class="fieldset mb-4">
            <legend class="fieldset-legend">Tag Name</legend>
            <input type="text" name="name" class="input w-full" value="{{ old('name', $tag->name) }}" required />
            @error('name')
                <p class="label text-red-500">{{ $message }}</p>
            @enderror
        </fieldset>
        <button class="btn btn-primary">Update Tag</button>
    </form>

    <a href="{{ route('tags.index') }}" class="btn btn-secondary mt-4">Back to Tags</a>
</div>
@endsection
