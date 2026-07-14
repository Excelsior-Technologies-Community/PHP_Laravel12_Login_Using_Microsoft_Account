<?php

namespace App\Http\Controllers;

use App\Models\LoginHistory;


class LoginHistoryController extends Controller
{

    public function index()
    {
        $histories = LoginHistory::with('user')
            ->latest()
            ->paginate(10);

        return view(
            'login-history.index',
            compact('histories')
        );
    }
}
