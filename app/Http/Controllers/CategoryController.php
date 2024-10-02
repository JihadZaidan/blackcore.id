<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Category::query();
        if (request()->filled('search')) {
            $query = $query->where('category_name', 'like', '%' . request('search') . '%');
        } else {
            $query = $query->latest();
        }

        if ($request->ajax() || $request->wantsJson()) {
            $categories = $query->get();

            return response()->json($categories);
        }

        $categories = $query->paginate(20);

        return view('admin.categories.index', compact('categories'));
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
            'category_name' => 'required|max:255',
            'slug' => 'required|max:255',
        ]);

        Category::create($request->all());

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(["success" => true]);
        }

        return redirect()->route('admin.categories.index')->with('success', 'Berhasil menambah data kategori');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'category_name' => 'required|max:255',
            'slug' => 'required|max:255|unique:categories,slug,' . $category->id,
        ]);

        $category->update($request->all());

        return redirect()->route('admin.categories.index')->with('success', 'Berhasil mengupdate data kategori');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Berhasil menghapus data kategori');
    }
}
