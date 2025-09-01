<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Crypt;

class VerifiedEmailController extends Controller
{
    public function verifiedEmail(Request $request)
    {
        try {
            $token = $request->has('token') ? $request->token : throw new DecryptException();
            $decryptedPayload = Crypt::decryptString($token);

            $payload = json_decode($decryptedPayload, true);

            $email = $payload['email'];
            $expires = $payload['expires'];
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return redirect()
                ->route('home')
                ->with('error', 'Invalid or malformed token.');
        }

        if ($expires < now()->timestamp) {
            return redirect()->route('home')->with('error', 'Password reset link has expired. Please try again.');
        }

        $user = User::where('email', $email)->first();
        if (!$user) {
            return redirect()->route('home')->with('error', 'User not found for this token.');
        }

        $user->forceFill([
            'email_verified_at' => Carbon::now(),
        ]);
        $user->save();

        return redirect()
            ->route('home')
            ->with('success', 'Your email has been verified successfully.');
    }
}
