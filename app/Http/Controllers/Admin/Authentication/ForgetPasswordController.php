<?php

namespace App\Http\Controllers\Admin\Authentication;

use App\Http\Controllers\Controller;
use App\Jobs\SendPasswordResetEmail;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ForgetPasswordController extends Controller
{
    public function sendLinkToMail(User $user)
    {
        $token = Str::random(64);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $user->email],
            [
                'token' => $token,
                'created_at' => now()
            ]
        );

        $resetUrl = url('/reset-password/' . $token . '?email=' . urlencode($user->email));

        SendPasswordResetEmail::dispatch($user, $resetUrl);

        return redirect()
            ->route('admin.user.show', $user)
            ->with('success', "A link will be sent to email {$user->email}");
    }
}
