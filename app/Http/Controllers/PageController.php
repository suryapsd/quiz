<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function dashboard(Request $request) {
        $user = $request->user();
        if($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        if($user->role === 'user') {
            return redirect()->route('user.dashboard');
        }
        return redirect()->route("landing");
    }

    public function profile(Request $request) {
        $user = $request->user();
        if($user->role === 'admin') {
            return redirect()->route('admin.profile');
        }
        if($user->role === 'siswusera') {
            return redirect()->route('user.profile');
        }
        return redirect()->route("landing");
    }
}
