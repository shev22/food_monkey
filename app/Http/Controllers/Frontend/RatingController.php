<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Rating;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function add(Request $request)
    {
        $stars_rate = $request->input('product_rating');
        $product_id = $request->input('product_id');

        $product_check = Product::where('id', $product_id)
            ->where('status', '0')
            ->first();
        if ($product_check) {
            $existing_rating = Rating::where('prod_id', $product_id)->first();
            if ($existing_rating) {
                $existing_rating->stars_rated = $stars_rate;
                $existing_rating->update();
            } else {
                Rating::create([
                    'user_id' => Auth::id(),
                    'prod_id' => $product_id,
                    'stars_rated' => $stars_rate,
                ]);
            }
            return redirect()
                ->back()
                ->with('status', 'Thank you for rating this product');
        } else {
            return redirect()
                ->back()
                ->with('status', 'The link was broken');
        }
    }
}
