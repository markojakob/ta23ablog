<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Image;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::paginate();
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {


        $post = new Post($request->validated());
        $post->user()->associate(Auth::user());
        $post->category()->associate($request->validated('category_id'));
        $post->save();
        $image = new Image();
        $image->path = $request->validated('image')->store('', ['disk' => 'public']);
        $image->post()->associate($post);
        $image->save();

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->update($request->validated());
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index');
    }

    public function deleted(){
        $posts = Post::onlyTrashed()->paginate();
        return view('posts.index', compact('posts'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function restore($post)
    {
        $post = Post::onlyTrashed()->where('id', $post)->firstOrFail();
        $post->restore();
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function permaDestroy($post)
    {
        $post = Post::onlyTrashed()->where('id', $post)->firstOrFail();
        $post->forceDelete();
        return redirect()->route('posts.deleted');
    }
}
