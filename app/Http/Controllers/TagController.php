<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Tag::query();
        if (request()->filled('search')) {
            $query = $query->where('tag_name', 'like', '%' . request('search') . '%');
        } else {
            $query = $query->latest();
        }

        if ($request->ajax() || $request->wantsJson()) {
            $tags = $query->get();

            return response()->json($tags);
        }

        $tags = $query->paginate(20);

        return view('admin.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tag_name' => 'required|max:255',
            'slug' => 'required|max:255',
        ]);

        Tag::create($request->all());

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(["success" => true]);
        }

        return redirect()->route('admin.tags.index')->with('success', 'Berhasil menambah data tag');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        return view('admin.tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'tag_name' => 'required|max:255',
            'slug' => 'required|max:255|unique:tags,slug,' . $tag->id,
        ]);

        $tag->update($request->all());

        return redirect()->route('admin.tags.index')->with('success', 'Berhasil mengupdate data tag');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();

        return redirect()->route('admin.tags.index')->with('success', 'Berhasil menghapus data tag');
    }
}
