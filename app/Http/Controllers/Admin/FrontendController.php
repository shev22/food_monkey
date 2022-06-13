<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    public function index()
    {

        $products  = Product::all()->count();
        $category  = Category::all()->count();
        $orders    = Order::all()->count();
        $users     = User::all()->count();
        $pending_orders = Order::where('status','0')->count();
        $completed_orders = Order::where('status', '1')->count();

        return view('admin.index', compact('products','category','orders','users','pending_orders','completed_orders'));
    }
}
