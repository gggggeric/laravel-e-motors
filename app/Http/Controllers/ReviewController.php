<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::all();
        return view('reviews.index', compact('reviews'));
    }

    public function create()
    {
        return view('reviews.create');
    }

    public function store(Request $request)
    {
        Review::create($request->all());
        return redirect()->route('reviews.index');
    }

    public function show(Review $review)
    {
        return view('reviews.show', compact('review'));
    }

    public function edit(Review $review)
    {
        return view('reviews.edit', compact('review'));
    }
    
    public function update(Request $request, Review $review)
    {
        // Validate the request data
        $request->validate([
            'commentername' => 'required|string|max:255',
            'comments' => 'required|string',
            // Add validation rules for other fields if necessary
        ]);
    
        // Update the review with the request data
        $review->update($request->all());
    
        // Redirect back to the edit page with a success message
        return redirect()->route('reviews.edit', $review->id)->with('success', 'Review updated successfully');
    }
    
    public function destroy(Review $review)
    {
        $review->delete();
        
        return redirect()->route('reviews.index')->with('success', 'Review deleted successfully');
    }
    
}
