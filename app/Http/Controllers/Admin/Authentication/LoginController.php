<?php

namespace App\Http\Controllers\Admin\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\LoginRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    private const ADMIN_ROLE = 'admin';

    public function view(?String $role = null)
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        if ($role == self::ADMIN_ROLE) {
            return view('Admin.Authentication.login');
        }

        return redirect()->route('authentication.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember');

        if (Auth::once($credentials)) {
            if ($user = User::where('email', $request->email)->where('role_id', Role::getRoleForAdmin())->first()) {
                Auth::login($user, $remember);

                return redirect()
                    ->route('posts.index', status: Response::HTTP_MOVED_PERMANENTLY);
            }
        }

        throw ValidationException::withMessages([
            'email' => __('auth.failed'),
        ]);
    }
}
