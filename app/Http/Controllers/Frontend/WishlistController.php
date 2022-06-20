<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlist = Wishlist::where('user_id', Auth::id())->get();
        return view('frontend.wishlist', compact('wishlist'));
    }

    public function add(Request $request)
    {
        if (Auth::check()) {
            $prod_id = $request->input('product_id');
            if (Product::find($prod_id)) {
                $wishlist = new Wishlist();
                $wishlist->prod_id = $prod_id;
                $wishlist->user_id = Auth::id();
                $wishlist->save();

                return response()->json([
                    'status' => 'Product added to Wishlist',
                ]);
            } else {
                return response()->json(['status' => 'Product not found']);
            }
        } else {
            return response()->json(['status' => 'login to continue']);
        }
    }

    public function destroy(Request $request)
    {
        if (Auth::check()) {
            $prod_id = $request->input('prod_id');
            if (
                Wishlist::where('prod_id', $prod_id)
                    ->where('user_id', Auth::id())
                    ->exists()
            ) {
                $item = Wishlist::where('prod_id', $prod_id)
                    ->where('user_id', Auth::id())
                    ->first();
                $item->delete();
                return response()->json([
                    'status' => 'Product deleted successfully',
                ]);
            }
        } else {
            return response()->json(['status' => 'login to continue']);
        }
    }

    public function wishlistCount()
    {
        $wishcount = Wishlist::where('user_id', Auth::id())->count();

        return response()->json(['count' => $wishcount]);
    }
}
