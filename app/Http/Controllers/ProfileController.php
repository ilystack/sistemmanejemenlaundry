<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * Update admin settings (logo, etc)
     */
    public function updateSettings(Request $request): RedirectResponse
    {
        $user = $request->user();

        // Validate request
        $validated = $request->validate([
            'laundry_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle logo upload
        if ($request->hasFile('laundry_logo')) {
            // Delete old logo if exists
            if ($user->laundry_logo && \Storage::exists($user->laundry_logo)) {
                \Storage::delete($user->laundry_logo);
            }

            // Store new logo
            $path = $request->file('laundry_logo')->store('laundry-logos', 'public');
            $user->laundry_logo = $path;
        }

        $user->save();

        return back()->with('toast', [
            'variant' => 'success',
            'title' => 'Berhasil',
            'message' => 'Settings berhasil diupdate!'
        ]);
    }
}
