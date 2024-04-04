<?php

namespace App\Http\Controllers;

use App\Models\User;
use ConsoleTVs\Charts\Facades\Charts;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::withTrashed()->get();
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'nullable|string|min:8', // Password is now nullable
            'new_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image is now nullable
        ]);

        $user = User::findOrFail($id);

        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->contact = $request->contact;
        $user->email = $request->email;

        // Update password only if provided
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        // Update image only if provided
        if ($request->hasFile('new_image')) {
            $image = $request->file('new_image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/images', $imageName); // Store the image in storage
            $user->image_path = 'images/' . $imageName; // Store image path in database
        }

        $user->save();
        return redirect()->route('user.index')->with('success', 'User information updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->back()->with('success', 'User deleted successfully');
    }

    public function restore($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->restore();
        return redirect()->back()->with('success', 'User restored successfully');
    }

    public function destroyforuser($id)
    {
        $user = User::findOrFail($id);

        // Change the status to 'deactivated'
        $user->update(['status' => 'deactivated']);

        return redirect()->route('login')->with('success', 'User deactivated successfully');

    }

}
