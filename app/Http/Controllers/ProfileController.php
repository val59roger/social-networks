<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\ProfileUsersUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;

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
     * Update the user's information.
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
     * Update the profile's information.
     */
    public function updateUserDetails(ProfileUsersUpdateRequest $request)
    {
        // Récupérer l'utilisateur authentifié
        $user = $request->user();

        // Mise à jour du pseudo
        $user->pseudo = $request->input('pseudo');

        // Gestion de l'image
        if ($request->hasFile('url_profile')) {
            $file = $request->file('url_profile');
            $path = $file->store('profile_photos', 'public'); // Stockage dans storage/app/public/profile_photos
            $user->url_profile = $path;
        }

    $user->save();

        // Rediriger avec un message de succès
        return redirect()->route('profile.edit')->with('status', 'profile-updated');
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

    public function dashboard(Request $request): View
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $postsCount = $user->posts()->count();
        $followersCount = $user->followers()->count();
        $followingCount = $user->follows()->count();
        $totalLikes = $user->posts()->withCount('likes')->get()->sum('likes_count');
        $totalComments = $user->comments()->count();

        return view('dashboard', compact('user', 'followersCount', 'followingCount', 'postsCount', 'totalLikes', 'totalComments'));
    }

    public function show(User $user)
    {
        if ($user->id === Auth::id()) {
            return redirect()->route('dashboard'); // renvoie vers le dashboard de la personne connecté.
        }
        $posts = $user->posts()->latest()->get(); // Récupérer les posts de l'utilisateur
        return view('profile.show', compact('user', 'posts'));
    }

    /* Mise en place de la fonction de follow des users */
    public function toggleFollow(User $user)
    {
        /** @var \App\Models\User $authUser */
        $authUser = Auth::user(); // Récupère l'utilisateur connecté

        if ($authUser->id === $user->id) {
            return back()->with('error', 'Vous ne pouvez pas vous suivre vous-même.');
        }

        if ($authUser->follows()->where('followed_id', $user->id)->exists()) {
            $authUser->follows()->detach($user->id);
        } else {
            $authUser->follows()->attach($user->id);
        }

        return back();
    }
}
