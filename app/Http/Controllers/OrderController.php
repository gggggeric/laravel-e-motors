<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmation; // Corrected import statement

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

    public function edit($productId)
{
    // Fetch the user ID of the authenticated seller
    $userId = auth()->id();

    // Fetch all orders associated with the product ID and the authenticated seller's user ID,
    // eager loading the 'user' relationship
    $orders = Order::with('user')
                    ->whereHas('product', function ($query) use ($productId, $userId) {
                        $query->where('id', $productId)
                              ->where('user_id', $userId);
                    })
                    ->get();

    // Pass the fetched orders data to the view
    return view('order.edit', ['orders' => $orders]);
}

public function updateStatus(Request $request)
{
    // Validate the incoming request data
    $request->validate([
        'orderId' => 'required|numeric',
        'orderStatus' => 'required|in:Paid,Not Paid',
    ]);

    // Retrieve the order ID and new status from the request
    $orderId = $request->input('orderId');
    $newStatus = $request->input('orderStatus');

    // Find the order by ID
    $order = Order::findOrFail($orderId);

    // Update the order status
    $order->orderStatus = $newStatus;
    $order->save();

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Order status updated successfully');
}



    public function showOrders() {
        $user = auth()->user(); // Assuming you're using authentication
        $order = Order::where('user_id', $user->id)->get(); // Fetch orders for the authenticated user
        
        return view('order.show', ['orders' => $order]); // Pass the $orders variable to the view
    }

    public function create($productID) {
        return view('order.create', ['productID' => $productID]);
    }
    
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'productID' => 'required|numeric',
            'userID' => 'required|numeric',
            'orderStatus' => 'required|in:Paid,Not Paid',
            'shippingAddress' => 'required|string',
            'email' => 'required|email',
            'modeOfPayment' => 'required|string',
            'quantity' => 'required|numeric',
        ]);

        // Fetch the product associated with the order
        $product = Product::find($validatedData['productID']);

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found!');
        }

        // Ensure there's enough quantity available
        if ($product->quantity < $validatedData['quantity']) {
            return redirect()->back()->with('error', 'Insufficient quantity available!');
        }

        // Calculate total
        $total = $product->amount * $validatedData['quantity'];

        // Create a new order instance
        $order = new Order();

        // Fill the order instance with the validated data
        $order->productID = $validatedData['productID'];
        $order->userID = $validatedData['userID'];
        $order->orderStatus = $validatedData['orderStatus'];
        $order->shippingAddress = $validatedData['shippingAddress'];
        $order->email = $validatedData['email'];
        $order->modeOfPayment = $validatedData['modeOfPayment']; // New field
        $order->quantity = $validatedData['quantity'];
        $order->total = $total; // Assign the calculated total

        // Save the order to the database
        $order->save();

        // Deduct the ordered quantity from the product's quantity
        $product->quantity -= $validatedData['quantity'];
        $product->save();

        // Send order confirmation email
        Mail::to($order->email)->send(new OrderConfirmation($order)); // Use OrderCompleted instead of OrderConfirmation

        // Redirect the user to the review page for the created order
        return redirect()->route('order.review', $order->id)->with('success', 'Order created successfully! An email has been sent for order confirmation.');
    }
    
   
    public function review($orderId)
    { 
        $order = Order::findOrFail($orderId);
        return view('order.review', compact('order'));
    }



    
    public function submitReview(Request $request, $orderId)
    {
        // Validate the incoming request data for the review
        $validatedData = $request->validate([
            'commentername' => 'required|string',
            'comments' => 'required|string',
            'reviewphoto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust validation rules for the review photo as needed
        ]);

        // Find the order associated with the given orderId
        $order = Order::findOrFail($orderId);

        // Create a new review instance
        $review = new Review();

        // Fill the review instance with the validated data
        $review->userid = auth()->id(); // Assuming the user is authenticated, you can change this logic as needed
        $review->orderid = $orderId;
        $review->commentername = $validatedData['commentername'];
        $review->comments = $validatedData['comments'];

        // Check if a review photo is uploaded
        if ($request->hasFile('reviewphoto')) {
            // Handle the review photo upload
            $reviewPhotoPath = $request->file('reviewphoto')->store('review-photos'); // Store the review photo in the storage/app/public directory
            $review->reviewphoto = $reviewPhotoPath;
        }

        // Save the review to the database
        $review->save();

        // Redirect the user to a relevant page after successfully submitting the review
        return redirect()->route('home')->with('success', 'Review submitted successfully!');
    }
}
