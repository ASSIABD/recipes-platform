<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profiles.edit');
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = auth()->user();

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            $image = $request->file('avatar');
            $imageName = 'avatar_' . time() . '.' . $image->getClientOriginalExtension();
            
            // Store in public/avatars directory
            $path = $image->storeAs('avatars', $imageName, 'public');
            
            // Delete old avatar if exists
            if ($user->avatar && $user->avatar !== 'avatars/avatarInconnue.jpg') {
                Storage::disk('public')->delete(str_replace('/storage/', '', $user->avatar));
            }
            
            $user->avatar = '/storage/' . $path;
        }

        // Update other profile information
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully!');
    }
}
