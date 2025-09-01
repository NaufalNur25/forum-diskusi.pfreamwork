<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use App\Jobs\SendVerifiedEmail;

class VerifiedEmailService
{
    private const EXPIRED = 15; //minutes

    public function send(User $user): bool
    {
        if ($user->hasVerifiedEmail()) {
            return false;
        }

        $payload = [
            'email' => $user->email,
            'expires' => now()->addMinutes(self::EXPIRED)->timestamp,
        ];

        $token = Crypt::encryptString(json_encode($payload));
        $verifiedUrl = url('/verified' . '?token=' . $token);

        SendVerifiedEmail::dispatch($user, $verifiedUrl, self::EXPIRED);

        return true;
    }
}
