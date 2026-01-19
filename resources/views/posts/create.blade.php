@extends('partials.layout')
@section('title', 'New Post')
@section('content')
    <div class="card bg-base-300 w-1/2 mx-auto">
        <div class="card-body">
            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <fieldset class="fieldset">
                    <legend class="fieldset-legend">@lang('Title')</legend>
                    <input type="text" name="title" class="input w-full" value="{{ old('title') }}"
                        placeholder="@lang('Title')" required autofocus />
                    @error('title')
                        <p class="label">{{ $message }}</p>
                    @enderror
                </fieldset>
                <fieldset class="fieldset">
                    <legend class="fieldset-legend">@lang('Content')</legend>
                    <textarea type="text" name="body" class="textarea w-full" rows="12" placeholder="@lang('Content')">{{ old('body') }}</textarea>
                    @error('body')
                        <p class="label">{{ $message }}</p>
                    @enderror
                </fieldset>
                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Categories</legend>
                    <select class="select w-full" name="category_id">
                        <option disabled selected>Pick a Category</option>
                        @foreach (App\Models\Category::all() as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="label">{{ $message }}</p>
                    @enderror
                </fieldset>
                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Pick a file</legend>
                    <input name="image" type="file" class="file-input w-full" />
                    <label class="label">Max size 2MB</label>
                </fieldset>
                <button class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
@endsection
