<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\CreateAccountRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    public function view()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        return view('Authentication.register');
    }

    public function register(CreateAccountRequest $request)
    {
        $inputRequest = $request->all();
        $inputRequest['role_id'] = Role::getRoleForUser();

        try {
            $user = User::create($inputRequest);

            Auth::login($user, remember: false);

            return redirect()
                ->route('home', status: Response::HTTP_MOVED_PERMANENTLY)
                ->with('success', 'New account have been created!');
        } catch (\Exception $e) {
            Log::error('Error: ' . $e->getMessage());

            return redirect()
                ->back(status: Response::HTTP_MOVED_PERMANENTLY)
                ->with('error', 'Sorry we got problem right now.');
        }
    }
}
