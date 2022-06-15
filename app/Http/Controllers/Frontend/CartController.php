<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{   
      public $cart_product_id;


    public function addProduct(Request $request)
    {
        $product_id = $request->input('product_id');
        $product_qty = $request->input('product_qty');
        $product_qty = null
            ? ($product_qty = '1')
            : ($product_qty = $request->input('product_qty'));

        if (Auth::check()) {
            $prod_check = Product::where('id', $product_id)->first();

            if ($prod_check) {
                if (
                    Cart::where('user_id', Auth::id())
                        ->where('prod_id', $product_id)
                        ->exists()
                ) {
                    return response()->json([
                        'status' =>
                            $prod_check->name . ' already added to cart',
                    ]);
                } else {
                    $cartItem = new Cart();
                    $cartItem->prod_id = $product_id;
                    $cartItem->user_id = Auth::id();
                    $cartItem->prod_qty = $product_qty;
                    $cartItem->save();
                    return response()->json([
                        'status' => $prod_check->name . ' added to cart',
                    ]);
                }
            }
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
            if (
                Cart::where('prod_id', $prod_id)
                    ->where('user_id', Auth::id())
                    ->exists()
            ) {
                $cartitem = Cart::where('prod_id', $prod_id)
                    ->where('user_id', Auth::id())
                    ->first();
                $cartitem->delete();
                return response()->json([
                    'status' => 'Product deleted successfully',
                ]);
            }
        } else {
            return response()->json(['status' => 'login to continue']);
        }
    }

    public function updateCart(Request $request)
    {
        $prod_id = $request->input('prod_id');
        $product_qty = $request->input('prod_qty');

        if (Auth::check()) {
            if (
                Cart::where('prod_id', $prod_id)
                    ->where('user_id', Auth::id())
                    ->exists()
            ) {
                $cart = Cart::where('prod_id', $prod_id)
                    ->where('user_id', Auth::id())
                    ->first();
                $cart->prod_qty = $product_qty;
                $cart->update();
                return response()->json(['status' => 'Quantity updated']);
            }
        }else{
            $cart = session('cart');
           //$price =  $request ->input('price');
           $cart [$prod_id]['prod_qty'] = (int)  $product_qty;
           
           session()->put('cart', $cart);
        }
    }

    public function cartCount()
    {
        $cartcount = Cart::where('user_id', Auth::id())->count();

        return response()->json(['count' => $cartcount]);
    }



    public function addSession(Request $request)
    {
          $this->cart_product_id = $request->input('product_id');

        if (!Auth::check()) {

            
            $product_id = $request->input('product_id');
            $product_qty = $request->input('product_qty');

          
            $prod_check = Product::where('id', $product_id)->first();
            $cat_check = Category::where('id', $product_id)->first();
            $cart = session()->get('cart', []);
            if (session('cart')) {
                $array_item = array_column(session('cart'), 'prod_id');
                if (in_array($product_id, $array_item)) {
                    $response = [
                        'status' =>
                            $prod_check->name . ' already added to cart',
                        'cart_count' => count(session('cart')),
                    ];

                    return response()->json($response);
                } else {
                    $cart[$product_id] = [
                        'prod_id' => $product_id,
                        'name' => $prod_check->name,
                        'prod_qty' => $product_qty,
                        'selling_price' => $prod_check->selling_price,
                        'image' => $prod_check->image,
                    ];
                    session()->put('cart', $cart);

                    $response = [
                        'status' => $prod_check->name . ' added to cart',
                        'cart_count' => count(session('cart')),
                    ];

                    return response()->json($response);
                }
            } else {
                $cart[$product_id] = [
                    'prod_id' => $product_id,
                    'name' => $prod_check->name,
                    'prod_qty' => $product_qty,
                    'selling_price' => $prod_check->selling_price,
                    'image' => $prod_check->image,
                   
                ];
                session()->put('cart', $cart);

                $response = [
                    'status' => $prod_check->name . ' added to cart',
                    'cart_count' => count(session('cart')),
                ];

                return response()->json($response);
            }
        }
    }

    public function viewSessionCart()
    {
        //  $products =  Product::where('id', $this->cart_product_id)->first();
        //  $category =  Category::where('id',$this->cart_product_id)->first();

        // die(var_dump( $this->cart_product_id));

            return view('frontend.session_cart');
        
    }

    public function deleteSessionCart(Request $request)
    {
        if ($request->product_id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->product_id])) {
                unset($cart[$request->product_id]);
                session()->put('cart', $cart);
            }

            $response = [
                'status' => 'removed from cart',
                'cart_count' => count(session('cart')),
            ];

            return response()->json($response);

        }

    }
    }

