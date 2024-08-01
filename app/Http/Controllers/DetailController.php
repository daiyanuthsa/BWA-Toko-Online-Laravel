<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;

use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;

class DetailController extends Controller
{


    public function index(Request $request, $id)
    {
        $product = Product::with(['galleries', 'user'])->where('slug', $id)->firstOrFail();
        return view("pages.detail", ["product" => $product]);
    }

    public function addCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // Memastikan bahwa pengguna telah terautentikasi
        if (auth()->check()) {
            $cart = new Cart();
            $cart->products_id = $product->id;
            $cart->users_id = auth()->id();
            $cart->save();

            return redirect()->route('cart')->with('success', 'Product added to cart!');
        } else {
            return redirect()->route('login')->with('error', 'You must be logged in to add products to the cart.');
        }
    }
}
