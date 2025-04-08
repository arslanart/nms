<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function admin()
    {
        $user = Auth::user();
        if ($user->user_type !== 'admin') {
            abort(403, 'คุณไม่มีสิทธิ์เข้าถึงหน้านี้');
        }
        dd(Auth::user());

        return view('dashboard'); // resources/views/dashboard.blade.php
    }

    public function user()
    {
        $user = Auth::user();
        if ($user->user_type !== 'user') {
            abort(403, 'คุณไม่มีสิทธิ์เข้าถึงหน้านี้');
        }

        return view('user-dashboard'); // resources/views/user-dashboard.blade.php
    }
}
