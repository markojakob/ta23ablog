<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{

    public function index()
    {
        $tags = Tag::paginate(); 
        return view('tags.index', compact('tags'));
    }


    public function create()
    {
        return view('tags.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:tags,name',
        ]);

        Tag::create($request->only('name'));

        return redirect()->route('tags.index')->with('success', 'Tag created successfully.');
    }


    public function edit(Tag $tag)
    {
        return view('tags.edit', compact('tag'));
    }


    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'name' => 'required|string|unique:tags,name,' . $tag->id,
        ]);

        $tag->update($request->only('name'));

        return redirect()->route('tags.index')->with('success', 'Tag updated successfully.');
    }


    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect()->route('tags.index')->with('success', 'Tag deleted successfully.');
    }


    public function deleted()
    {
        $tags = Tag::onlyTrashed()->paginate();
        return view('admin.tags.index', compact('tags'));
    }


    public function restore($tag)
    {
        $tag = Tag::onlyTrashed()->where('id', $tag)->firstOrFail();
        $tag->restore();
        return redirect()->route('tags.index');
    }

    public function permaDestroy($tag)
    {
        $tag = Tag::onlyTrashed()->where('id', $tag)->firstOrFail();
        $tag->forceDelete();
        return redirect()->route('tags.deleted');
    }
}
