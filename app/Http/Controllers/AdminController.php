<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rules\Password;

class AdminController extends Controller
{

    public function edit(User $users){
     return view('admin.edit', ['users' => $users]);
    //  dd($users);
     }

     public function update(User $user, Request $request) {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string|min:8',
            'status' => 'required|in:activated,deactivated',
            'userImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Handle file upload for user image
        if ($request->hasFile('userImage')) {
            $image = $request->file('userImage');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/user_images', $imageName); // Store the image in the specified directory
        } else {
            $imageName = $user->user_image; // Retain the existing image name if no new image is uploaded
        }
    
        // Update the user's attributes
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']);
        $user->status = $validatedData['status'];
        $user->user_image = $imageName;
    
        // Save the updated user to the database
        $user->save();
    
        return redirect()->route('admin.create')->with('success', 'Successfully updated the user data.');
    }
     
     public function destroy(User $users){
         $users->delete();
         return redirect(route('admin.create'));
     }

  public function create() {
    $users = User::all();
    return view('admin.create', ['users' => $users]);
  }

  public function store(Request $request) {
    // Validate the form data
    $validatedData = $request->validate([
        'adminUsername' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'adminPassword' => 'required|string|min:8',
        'usertype' => 'required|string',
        'userImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate and specify the image file
        'status' => 'required|string|in:activated,deactivated', // Ensure status is one of the specified values
    ]);

    // Handle file upload for user image
    if ($request->hasFile('userImage')) {
        $image = $request->file('userImage');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->storeAs('public/user_images', $imageName); // Store the image in the specified directory
    } else {
        $imageName = null; // If no image is uploaded, set imageName to null
    }

    // Create a new User instance
    $user = new User();
    $user->name = $request->input('adminUsername');
    $user->email = $request->input('email');
    $user->password = Hash::make($request->input('adminPassword'));
    $user->usertype = $request->input('usertype');
    $user->user_image = $imageName; // Set the user_image field with the uploaded image name or null
    $user->status = $request->input('status'); // Set the status field

    // Save the user to the database
    $user->save();

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Admin information saved successfully.');
}

  
    
}
