<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addProduct(Request $request)
    {



        $product_id = $request->input('product_id');
        $product_qty = $request->input('product_qty');
        $product_qty = null ? $product_qty  = '1':
        $product_qty = $request->input('product_qty');
    
        if (Auth::check()) {

            $prod_check = Product::where('id', $product_id)->first();

            if ($prod_check) {
                if (Cart::where('user_id', Auth::id())->where('prod_id', $product_id)->exists()) {
                    return response()->json(['status' => $prod_check->name . " already added to cart"]);
                } else {
                    $cartItem = new Cart();
                    $cartItem->prod_id = $product_id;
                    $cartItem->user_id = Auth::id();
                    $cartItem->prod_qty = $product_qty;
                    $cartItem->save();
                    return response()->json(['status' => $prod_check->name . " added to cart"]);
                }
            }
        } else {
            return response()->json(['status' => "login to continue"]);
        }
    }

    public function viewCart()
    {
        $cartItems = Cart::where('user_id', Auth::id())->get();
       
        return view('frontend.cart', compact('cartItems'));
    }

    public function destroyProduct(Request $request)
    {
        if (Auth::check()) {
            $prod_id = $request->input('prod_id');
            if (Cart::where('prod_id', $prod_id)->where('user_id', Auth::id())->exists())
             {
                $cartitem = Cart::where('prod_id', $prod_id)->where('user_id', Auth::id())->first();
                $cartitem->delete();
                return response()->json(['status' => "Product deleted successfully"]);
            }
        } else {
            return response()->json(['status' => "login to continue"]);
        }
    }

    public function updateCart(Request $request)
    {
        
        $prod_id = $request->input('prod_id');
        $product_qty = $request->input('prod_qty');

        if(Auth::check())
        {
            if (Cart::where('prod_id', $prod_id)->where('user_id', Auth::id())->exists())
            {
                $cart = Cart::where('prod_id', $prod_id)->where('user_id', Auth::id())->first();
                $cart -> prod_qty =  $product_qty;
                $cart->update();
                return response()->json(['status' => "Quantity updated"]);
            }
        }
    }


    public function cartCount()
    {
       $cartcount = Cart::where('user_id', Auth::id())->count();

       return response()->json(['count' => $cartcount]);

    }

}
