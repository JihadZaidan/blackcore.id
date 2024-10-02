<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->filled('search')) {
            $products = Product::where('name', 'like', '%' . request('search') . '%')->latest()->paginate(20);
        } else {
            $products = Product::latest()->paginate(20);
        }

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:products,slug',
            'description' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'photo' => 'required',
        ]);

        // save photo
        $path = $request->file('photo')->store('uploads/product', 'public');

        Product::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'photo' => $path,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Berhasil menambah data produk');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);

        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);

        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:products,slug,' . $id,
            'description' => 'required',
            'price' => 'required',
            'stock' => 'required',
        ]);

        $product = Product::find($id);

        // save photo
        $oldPhoto = $product->photo;
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('uploads/product', 'public');
            $product->photo = $path;
            // delete old photo
            if ($oldPhoto) {
                Storage::disk('public')->delete($oldPhoto);
            }
        } else {
            $path = $product->photo;
        }

        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;

        $product->save();

        return redirect()->back()->with('success', 'Berhasil mengedit data produk');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        $productName = $product->name;
        $product->delete();
        // delete old photo
        if ($product->photo) {
            Storage::disk('public')->delete($product->photo);
        }

        return redirect()->route('admin.products.index')->with('success', "Produk $productName berhasil dihapus");
    }
}
