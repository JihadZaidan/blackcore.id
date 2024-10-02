<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Article;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FrontendController extends Controller
{
    public function index()
    {
        $products = Product::latest()->limit(5)->get();
        $articles = Article::where('is_published', '1')->latest()->limit(8)->get();

        return view('frontend.index', compact('products', 'articles'));
    }

    public function product(string $slug)
    {
        $product = Product::where('slug', $slug)->first();

        return view('frontend.product', compact('product'));
    }

    public function loginRegister()
    {
        $google_auth = base64_encode(Hash::make('google'));
        return view('frontend.loginregister', compact('google_auth'));
    }

    public function registerAction(Request $request)
    {
        // dd($request->get('mode'));
        $request->validateWithBag('register', [

        ]);

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users',
            'phone' => 'required',
            'address' => 'required',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput([...$request->all(), 'old_passwd' => $request->password])
                ->with('mode', $request->query('mode')); // Attach query parameters
        }

        // Create a new user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => bcrypt($request->password),
            'role' => 'user',
        ]);

        return redirect()->back()->with('success', 'Registrasi berhasil. Anda sudah bisa login.');
    }

    public function loginAction(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        // Attempt to log in the user
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Authentication passed
            return redirect()->intended(route('frontend.index'))->with('success', 'Login berhasil. Selamat datang ' . Auth::user()->name . '!');
        } else {
            // Authentication failed
            return redirect()->back()->with('error', 'Login gagal. Email atau password salah.');
        }
    }

    public function aboutUs()
    {
        return view('frontend.about_us');
    }

    public function article(string $slug)
    {
        $article = Article::where('slug', $slug)->first();
        return view('frontend.article', compact('article'));
    }

    public function cart(Request $request)
    {
        $carts = Cart::where('user_id', Auth::user()->id)->get();
        
        $totalPrice = 0;
        foreach ($carts as $cart) {
            $totalPrice += $cart->product->price * $cart->qty;
        }

        return view('frontend.cart', compact('carts', 'totalPrice'));
    }

    public function profile()
    {
        if (!Auth::check()) {
            return redirect()->route('frontend.login_register');
        }
        $user = Auth::user();
        return view('frontend.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email, ' . Auth::user()->id,
            'phone' => 'required',
            'address' => 'required',
        ]);

        $user = User::find(Auth::user()->id);

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

        return redirect()->back()->with('success', 'Profil berhasil diupdate');
    }

    public function checkout()
    {
        $carts = Cart::where('user_id', Auth::user()->id)->get();
        foreach ($carts as $cart) {
            $total = $cart->product->price * $cart->qty;
            $cart->total = $total;
        }

        return view('frontend.checkout', compact('carts'));
    }

    public function payment()
    {
        $carts = Cart::where('user_id', Auth::user()->id)->get();
        foreach ($carts as $cart) {
            $total = $cart->product->price * $cart->qty;
            $cart->total = $total;
        }

        return view('frontend.payment', compact('carts'));
    }

    public function orderTracking()
    {
        //
        return view('frontend.ordertracking');
    }

    public function livechat() 
    {
        //
        return view('frontend.livechat');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
