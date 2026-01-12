<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PublicController extends Controller
{
    public function index() {
        $posts = Post::with('user')->withCount('comments', 'likes')->latest()->simplePaginate(16);
        return view('welcome', compact('posts'));
    }

    public function post(Post $post) {
        $post->loadCount('comments', 'likes')->load('comments');
        return view('post', compact('post'));
    }

    public function like(Post $post) {
        $like = $post->likes()->where('user_id', Auth::user()->id)->first();
        if($like) {
            $like->delete();
        } else {
            $like = new Like();
            $like->post()->associate($post);
            $like->user()->associate(Auth::user());
            $like->save();
        }
        return redirect()->back();
    }

    public function category(Category $category) {
        $posts = $category->posts()
                        ->with('user')
                        ->withCount('comments', 'likes')
                        ->latest()
                        ->simplePaginate(16);

        return view('welcome', compact('posts'));
    }
}
