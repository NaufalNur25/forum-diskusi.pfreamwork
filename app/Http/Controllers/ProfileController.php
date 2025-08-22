<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function view()
    {
        // Ambil data user yang sedang login
        $user = Auth::user();

        // Kirim ke blade
        return view('Profile.view', compact('user'));
    }
}
