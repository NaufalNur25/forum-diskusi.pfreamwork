<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\CreateAccountRequest;
use App\Models\Role;
use App\Models\User;
use App\Services\VerifiedEmailService;
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

            $verifiedService = app(VerifiedEmailService::class);
            $verified = $verifiedService->send($user);

            if (!$verified) {
                return redirect()
                    ->route('admin.user.show', $user)
                    ->with('error', "Sorry this email was verified!");
            }

            Auth::login($user, remember: false);

            return redirect()
                ->route('home')
                ->with('success', 'New account have been created!');
        } catch (\Exception $e) {
            Log::error('Error: ' . $e->getMessage());

            return redirect()
                ->back()
                ->with('error', 'Sorry we got problem right now.');
        }
    }
}
