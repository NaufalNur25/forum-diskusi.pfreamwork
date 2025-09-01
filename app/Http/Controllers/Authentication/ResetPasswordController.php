<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\ResetPasswordRequest;
use App\Jobs\SendResetPasswordSuccessEmail;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    public function view(String $token)
    {
        $passwordReset = DB::table('password_reset_tokens')
            ->where('token', $token)
            ->first();

        if (
            !$passwordReset ||
            now()->diffInMinutes($passwordReset->created_at) > config('auth.passwords.users.expire')
        ) {
            return redirect()
                ->route('home')
                ->with('error', 'The password reset token is invalid or has expired.');
        }

        return view('Authentication.reset-password', [
            'token' => $token,
            'email' => $passwordReset->email
        ]);
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $passwordReset = DB::table('password_reset_tokens')->where('email', $request->email)->where('token', $request->token)->first();
        if (!$passwordReset) {
            return back()
                ->withErrors(['email' => trans(Password::INVALID_TOKEN)])
                ->withInput($request->only('email'));
        }


        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()
                ->withErrors(['email' => trans(Password::INVALID_USER)])
                ->withInput($request->only('email'));
        }

        $user->forceFill([
            'password' => $request->password,
            'email_verified_at' => Carbon::now(),
        ])->setRememberToken(Str::random(60));
        $user->save();

        DB::table('password_reset_tokens')->where('email', $request->email)->delete();
        Event::dispatch(new PasswordReset($user));

        SendResetPasswordSuccessEmail::dispatch($user);

        return redirect()
            ->route('authentication.login')
            ->with('success', 'Your password has been reset successfully. Please log in with your new password.');
    }
}
