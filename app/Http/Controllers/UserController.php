<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->filled('search')) {
            $users = User::where('name', 'like', '%' . request('search') . '%')
            ->where('role', 'user')
            ->latest()->paginate(20);
        } else {
            $users = User::latest()->where('role', 'user')->paginate(20);
        }


        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
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
            $path = $request->file('photo')->store('uploads/user', 'public');
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'role' => "user",
            'photo' => $path,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Berhasil menambah data user');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);

        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);

        return view('admin.users.edit', compact('user'));
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

        $user = User::find($id);

        $oldPhoto = $user->photo;
        if ($request->hasFile('photo')) {
            // store photo to public storage
            $path = $request->file('photo')->store('uploads/user', 'public');
            $user->photo = $path;
            // hapus foto lama
            if ($oldPhoto) {
                Storage::disk('public')->delete($oldPhoto);
            }
        }

        // update password jika ada
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;

        $user->save();

        return redirect()->back()->with('success', 'Berhasil mengedit data user');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $name = $user->name;

        // delete photo
        if ($user->photo) {
            Storage::disk('public')->delete($user->photo);
        }

        // delete user
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', "User $name berhasil dihapus");
    }
}
