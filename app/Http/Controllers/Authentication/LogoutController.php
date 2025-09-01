<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function __invoke(Request $request)
    {
        if (Auth::check()) {
            Auth::logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return redirect()
                ->route('authentication.login')
                ->with('success', 'Successfully logout.');
        }

        return redirect()
            ->route('authentication.login')
            ->with('error', 'Sorry, try to login/register first.');
    }
}
