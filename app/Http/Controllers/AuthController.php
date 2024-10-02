<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Can;

class AuthController extends Controller
{
    public function login()
    {
        if (Auth::check() && Auth::user()->role == 'admin') {
            return redirect()->route('admin.dashboard');
        }

        $google_auth = base64_encode(Hash::make('google'));
        return view('admin.login', compact('google_auth'));
    }

    public function register()
    {
        return view('admin.register');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/admin/login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        $remember = $request->has('remember_me') ? true : false;

        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();
            if ($user->role != 'admin') {
                return back()->with('error', 'Anda tidak punya hak akses untuk membuka dashboard admin');
            }
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'))->with('success', 'Login berhasil');
        }
        return back()->with('error', 'Email atau password yang Anda masukkan salah.');
    }

    public function dashboard() {
        $today = Carbon::now();
        $last_30_day_start = Carbon::now()->subDays(30);       
        $prev_30_day_end = $last_30_day_start->copy()->subDay();
        $prev_30_day_start = $prev_30_day_end->copy()->subDays(30);

        // hitung % user 30 hari
        $percent_user = 0;
        $total_user_30_day = User::where('role', 'user')->whereBetween('created_at', [$last_30_day_start, $today])->count();
        $total_user_prev_30_day = User::where('role', 'user')->whereBetween('created_at', [$prev_30_day_start, $prev_30_day_end])->count();

        if ($total_user_prev_30_day != 0) {
            $percent_user = ($total_user_30_day - $total_user_prev_30_day) / $total_user_prev_30_day * 100;
        }

        // hitung % product 30 hari
        $percent_product = 0;
        $total_product_30_day = Product::whereBetween('created_at', [$last_30_day_start, $today])->count();
        $total_product_prev_30_day = Product::whereBetween('created_at', [$prev_30_day_start, $prev_30_day_end])->count();

        if ($total_product_prev_30_day != 0) {
            $percent_product = ($total_product_30_day - $total_product_prev_30_day) / $total_product_prev_30_day * 100;
        }

        $prev_month = Carbon::now()->subMonth()->startOfMonth();
        $total_user = User::where('role', 'user')->count();
        $total_product = Product::count();
        
        return view('admin.dashboard', compact('total_user', 'total_product', 'percent_user', 'percent_product'));
    }

    public function profile()
    {
        $profile = Auth::user();
        return view('admin.profile', compact('profile'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email, '.$user->id,
            'phone' => 'required',
            'address' => 'required',
        ]);

        $oldPhoto = $user->photo;
        if ($request->hasFile('photo')) {
            // store photo to public storage
            $path = $request->file('photo')->store('uploads/admin', 'public');
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

        return redirect()->back()->with('success', 'Profil berhasil diupdate');
        
    }
}
