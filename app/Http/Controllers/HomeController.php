<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Order;
use App\Models\Review;
class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $user = Auth()->user();
    
            if ($user->usertype == 'user') {
                $products = Product::all();
                return view('dashboard', ['products' => $products]);
            } else if ($user->usertype == 'admin') {
                // Fetch counts for sellers, admins, and users
                $sellerCount = User::where('usertype', 'seller')->count();
                $adminCount = User::where('usertype', 'admin')->count();
                $userCount = User::where('usertype', 'user')->count();
                
                // Fetch total number of reviews
                $totalReviews = Review::count(); // Assuming you have a Review model
                
                // Debugging - check counts
                // dd($sellerCount, $adminCount, $userCount);
                
                return view('admin.adminHome', compact('sellerCount', 'adminCount', 'userCount', 'totalReviews'));
            } else if ($user->usertype == 'seller') {
                // Fetch a specific product ID associated with the seller, for example, the first product ID
                $product = Product::where('user_id', $user->id)->first();
                $productId = $product ? $product->id : null; // Assuming 'id' is the primary key column of the products table
                
                // Fetch the total number of users who bought products from the seller
                $totalUsersBought = Order::join('products', 'orders.productID', '=', 'products.id')
                    ->where('products.user_id', $user->id)
                    ->distinct('orders.userID')
                    ->count('orders.userID');
    
                return view('seller.sellerHome', compact('productId', 'totalUsersBought'));
            } else {
                // Handle other user types if necessary
            }
        } else {
            return redirect()->route('login');
        }
    }
    

}
