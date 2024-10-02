<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer|min:1',
        ]);

        $user = Auth::user();
        $product_id = $request->product_id;
        $qty = $request->qty;

        $msg = '';
        // Cek apakah produk sudah ada di cart
        $cartItem = Cart::where('user_id', $user->id)
                        ->where('product_id', $product_id)
                        ->first();

        if ($cartItem) {
            // Jika sudah ada, update qty
            $cartItem->qty += $qty;
            $cartItem->save();
            $msg = 'Berhasil memperbarui cart';
        } else {
            // Jika belum ada, buat entry baru di cart
            Cart::create([
                'user_id' => $user->id,
                'product_id' => $product_id,
                'qty' => $qty,
            ]);
            $msg = 'Berhasil menambah produk ke cart';
        }

        return redirect()->back()->with('success', $msg);;
    }

    // Mengupdate qty produk di cart
    public function updateCart(Request $request, $id)
    {
        $request->validate([
            'qty' => 'required|integer|min:1',
        ]);

        $cartItem = Cart::findOrFail($id);
        $cartItem->update([
            'qty' => $request->qty,
        ]);

        return redirect()->route('frontend.cart')->with('success', 'Berhasil mengubah kuantitas');
    }

    // Menghapus produk dari cart
    public function removeFromCart($id)
    {
        $cartItem = Cart::findOrFail($id);
        $cartItem->delete();

        return redirect()->route('frontend.cart')->with('success', 'Berhasil menghapus produk dari cart');
    }
}
