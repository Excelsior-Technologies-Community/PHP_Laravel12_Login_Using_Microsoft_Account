<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $totalUsers = User::count();

        $microsoftUsers = User::whereNotNull('microsoft_id')->count();

        $todayUsers = User::whereDate('created_at', today())->count();

        $latestUsers = User::when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
            })
            ->oldest()
            ->paginate(5)
            ->withQueryString();

        // Current logged-in user or first user for demo
        $currentUser = auth()->user() ?? User::first();

        return view('dashboard', compact(
            'search',
            'totalUsers',
            'microsoftUsers',
            'todayUsers',
            'latestUsers',
            'currentUser'
        ));
    }
}