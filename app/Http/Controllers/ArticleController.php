<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Article::with(['tags', 'category']);
        if (request()->filled('search')) {
            $query = $query->where('title', 'like', '%' . request('search') . '%');
        } else {
            $query = $query->latest();
        }

        $articles = $query->paginate(20);

        return view('admin.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.articles.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|max:255|unique:articles,slug,',
        ]);

        $path = null;
        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('uploads/articles', 'public');
        }

        $article = Article::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'content' => $request->content,
            'cover_image' => $path,
            'category_id' => $request->category_id,
            'user_id' => Auth::user()->id,
        ]);

        $tags_array = $request->tags ?? [];
        $article->tags()->sync($tags_array);


        return redirect()->route('admin.articles.index')->with('success', 'Berhasil menambah data artikel');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        $article->load(['tags', 'category']);
        return view('admin.articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.articles.edit', compact('article', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|max:255|unique:articles,slug,' . $article->id,
        ]);

        $path = $article->cover_image;
        if ($request->hasFile('cover_image')) {
            $newPath = $request->file('cover_image')->store('uploads/articles', 'public');
            
            if ($path) {
                Storage::disk('public')->delete($path);
            }
            $path = $newPath;
        }

        $article->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'content' => $request->content,
            'cover_image' => $path,
            'category_id' => $request->category_id,
            'user_id' => Auth::user()->id,
        ]);

        $tags_array = $request->tags ?? [];
        $article->tags()->sync($tags_array);


        return redirect()->route('admin.articles.index')->with('success', 'Berhasil mengubah data artikel');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('admin.articles.index')->with('success', 'Data artikel berhasil dihapus sementara');
    }

    public function publish(Article $article) 
    {
        $article->update([
            'is_published' => true
        ]);

        return redirect()->route('admin.articles.index')->with('success', 'Berhasil mempublikasikan artikel');
    }

    public function unpublish(Article $article) 
    {
        $article->update([
            'is_published' => false
        ]);

        return redirect()->route('admin.articles.index')->with('success', 'Berhasil membatalkan publikasi artikel');
    }

    public function uploadImage(Request $request){
        
        $path = $request->file('file')->store('uploads/articles', 'public');
        return response()->json(['location' => "/storage/$path"]); 
        
        /*$imgpath = request()->file('file')->store('uploads', 'public'); 
        return response()->json(['location' => "/storage/$imgpath"]);*/
    
    }
}
