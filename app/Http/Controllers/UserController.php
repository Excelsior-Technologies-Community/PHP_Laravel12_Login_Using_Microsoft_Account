<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $users = User::when($search, function ($query) use ($search) {

                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");

            })
            ->oldest()
            ->paginate(5)
            ->withQueryString();

        return view('users.index', compact('users', 'search'));
    }

    public function destroy(User $user)
    {
        // Prevent deleting yourself
        if ($user->id == auth()->id()) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return back()->with('success', 'User deleted successfully.');
    }
}