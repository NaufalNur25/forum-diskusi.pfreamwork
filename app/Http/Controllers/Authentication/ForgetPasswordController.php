<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\SendingEmailRequest;
use App\Jobs\SendPasswordResetEmail;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ForgetPasswordController extends Controller
{
    public function view()
    {
        return view('Authentication.forget-password');
    }

    public function sendLinkToMail(SendingEmailRequest $request)
    {
        $email = $request->email;

        if ($user = User::hasEmail($email)) {
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
        }

        return redirect()
            ->route('home', status: Response::HTTP_MOVED_PERMANENTLY)
            ->with('info', 'A link will be sent to your email account if it is linked to us.');
    }
}
