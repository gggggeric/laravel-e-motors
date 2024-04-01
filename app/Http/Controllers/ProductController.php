<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class ProductController extends Controller
{
    // public function createProduct() {

        
    //     $products = Product::all();
    //     return view('seller.createProduct', ['products' => $products]);
     
    // }

    public function createProduct() {
        // Get the ID of the currently authenticated user (seller)
        $sellerId = Auth::id();
        
        // Fetch only the products that belong to the current seller
        $products = Product::where('user_id', $sellerId)->get();

        // Return the view with the filtered products
        return view('seller.createProduct', compact('products'));
    }


    public function store(Request $request) {
        // Check if the user is authenticated
        if (Auth::check() && Auth::user()->usertype === 'seller') {
            // Validate the form data
            $validatedData = $request->validate([
                'product_name' => 'required|string|max:255',
                'amount' => 'required|numeric',
                'product_type' => 'required|string|max:255',
                'product_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Example validation for product image
                'quantity' => 'required|integer|min:0', // Validation for quantity
            ]);
    
            // Create a new Product instance
            $product = new Product();
            $product->user_id = Auth::id(); // Set the user_id to the ID of the authenticated user
            $product->product_name = $request->input('product_name');
            $product->amount = $request->input('amount');
            $product->product_type = $request->input('product_type');
    
            // Handle product image upload
            if ($request->hasFile('product_image')) {
                $imagePath = $request->file('product_image')->store('product_images', 'public');
                $product->product_image = $imagePath;
            }
    
            // Set the quantity
            $product->quantity = $request->input('quantity');
    
            // Save the product to the database
            $product->save();
    
            // Redirect back with a success message
            return redirect('/product/create')->with('success', 'Product created successfully.');
        } else {
            // Redirect back with an error message
            return redirect()->back()->with('error', 'Only sellers can create products.');
        }
    }
    

    public function edit(Product $product){
       return view('seller.editProduct', ['product' => $product]);
    // dd($product);
    }
    public function update(Product $product, Request $request){
        $validatedData = $request->validate([
            'product_name' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'product_type' => 'required|string|max:255',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Make product image optional
            'quantity' => 'required|integer|min:0', // Validation for quantity
        ]);
    
        // If there's a new product image uploaded, handle the image upload
        if ($request->hasFile('product_image')) {
            $imagePath = $request->file('product_image')->store('product_images', 'public');
            $validatedData['product_image'] = $imagePath;
        }
    
        // Update the product with the validated data including the quantity
        $product->update($validatedData);
    
        return redirect(route('seller.createProduct'))->with('success', 'Product updated successfully.');
    }
    


    public function destroy(Product $product){
        $product->delete();
        return redirect(route('seller.createProduct'));
    }

    public function search(Request $request)
    {
        // Get the search query from the request
        $searchQuery = $request->input('query');

        // Perform the search query
        $products = Product::where('product_name', 'like', "%$searchQuery%")->get();

        // Return the search results
        return view('seller.searchProducts', ['products' => $products, 'query' => $searchQuery]);
    }

  
}
