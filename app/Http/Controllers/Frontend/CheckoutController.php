<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItems;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use League\CommonMark\Extension\DescriptionList\Node\Description;

class CheckoutController extends Controller
{
    public function index()
    {
        $old_cartItems = Cart::where('user_id', Auth::id())->get();
        foreach ($old_cartItems as $item) {
            if (
                !Product::where('id', $item->prod_id)
                    ->where('qty', '>=', $item->prod_qty)
                    ->exists()
            ) {
                $removeItem = Cart::where('user_id', Auth::id())
                    ->where('prod_id', $item->prod_id)
                    ->first();
                $removeItem->delete();
            }
        }
        $cartItems = Cart::where('user_id', Auth::id())->get();

        return view('frontend.checkout', compact('cartItems'));
    }

    public function placeOrder(Request $request)
    {
        $total = 0;
        $cartitems_total = Cart::where('user_id', Auth::id())->get();
        foreach ($cartitems_total as $prod) {
            $total += $prod->product->selling_price;
        }

        $order = new Order();
        $order->user_id = Auth::id();
        $order->fname = $request->input('fname');
        $order->lname = $request->input('lname');
        $order->email = $request->input('email');
        $order->phone = $request->input('phone');
        $order->address = $request->input('address');
        $order->payment_mode = $request->input('payment_mode');
        $order->payment_id = $request->input('payment_id');
        $order->total_price = $total;
        $order->tracking_no = 'francois' . rand();
        $order->save();

        $cartItems = Cart::where('user_id', Auth::id())->get();
        foreach ($cartItems as $item) {
            OrderItems::create([
                'order_id' => $order->id,
                'prod_id' => $item->prod_id,
                'qty' => $item->prod_qty,
                'price' => $item->product->selling_price,
            ]);

            $prod = Product::where('id', $item->prod_id)->first();
            $prod->qty -= $item->prod_qty;
            $prod->update();
        }

        if (Auth::user()->address == null) {
            $user = User::where('id', Auth::id())->first();
            $user->fname = $request->input('fname');
            $user->lname = $request->input('lname');
            $user->phone = $request->input('phone');
            $user->address = $request->input('address');
            $user->address = $request->input('address');
            $user->update();
        }

        $cartItems = Cart::where('user_id', Auth::id())->get();
        Cart::destroy($cartItems);

        if (
            $request->input('payment_mode') == 'Paid by Razorpay' ||
            $request->input('payment_mode') == 'Paid by Paypal'
        ) {
            return response()->json(['status' => 'Order placed Successfully']);
        }
        return redirect('/')->with('status', 'Order placed Successfully');
    }

    public function razorPayCheck(Request $request)
    {
        $cartItems = Cart::where('user_id', Auth::id())->get();

        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item->prod_qty * $item->product->selling_price;
        }

        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $address = $request->input('address');

        return response()->json([
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'phone' => $phone,
            'address' => $address,
            'total_price' => $total,
        ]);
    }
}
