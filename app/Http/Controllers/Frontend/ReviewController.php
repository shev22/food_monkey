<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function add($product_slug)
    {
        $product = Product::where('slug', $product_slug)
            ->where('status', '0')
            ->first();

        if ($product) {
            return view('frontend.reviews.index', compact('product'));
        } else {
            return redirect()
                ->back()
                ->with('status', 'link is broken');
        }
    }

    public function create(Request $request)
    {
        $product_id = $request->input('product_id');
        $product = Product::where('id', $product_id)
            ->where('status', '0')
            ->first();

        if ($product) {
            $user_review = $request->input('user_review');
            $new_review = Review::create([
                'user_id' => Auth::id(),
                'prod_id' => $product_id,
                'user_review' => $user_review,
            ]);

            if ($new_review) {
                return redirect(
                    'category/' .
                        $product->category->slug .
                        '/' .
                        $product->slug
                )->with('status', 'Thank you for writing a review');
            }
        } else {
            return redirect()
                ->back()
                ->with('status', 'link is broken');
        }
    }
}
