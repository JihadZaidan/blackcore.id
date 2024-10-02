<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->filled('search')) {
            $admins = User::where('name', 'like', '%' . request('search') . '%')
            ->where('role', 'admin')
            ->latest()->paginate(20);
        } else {
            $admins = User::latest()->where('role', 'admin')->paginate(20);
        }


        return view('admin.admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.admins.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required',
            'address' => 'required',
            'password' => 'required',
        ]);

        $path = null;
        if ($request->hasFile('photo')) {
            // store photo to public storage
            $path = $request->file('photo')->store('uploads/admin', 'public');
        }

        $admin = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'role' => "admin",
            'photo' => $path,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('admin.admins.index')->with('success', 'Berhasil menambah admin');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $admin = User::find($id);

        return view('admin.admins.show', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $admin = User::find($id);

        return view('admin.admins.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email, '.$id,
            'phone' => 'required',
            'address' => 'required',
        ]);

        $admin = User::find($id);

        $oldPhoto = $admin->photo;
        if ($request->hasFile('photo')) {
            // store photo to public storage
            $path = $request->file('photo')->store('uploads/admin', 'public');
            // ganti foto
            $admin->photo = $path;
            // hapus foto lama
            if ($oldPhoto) {
                Storage::disk('public')->delete($oldPhoto);
            }
        }

        // update password jika ada
        if ($request->filled('password')) {
            $admin->password = bcrypt($request->password);
        }

        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->address = $request->address;

        $admin->save();

        return redirect()->back()->with('success', 'Berhasil mengedit admin');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $admin = User::find($id);
        $name = $admin->name;

        // delete photo
        if ($admin->photo) {
            Storage::disk('public')->delete($admin->photo);
        }

        // delete admin
        $admin->delete();

        return redirect()->route('admin.admins.index')->with('success', "Admin $name berhasil dihapus");
    }
}
