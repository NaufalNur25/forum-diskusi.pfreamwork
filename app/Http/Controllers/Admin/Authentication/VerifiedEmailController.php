<?php

namespace App\Http\Controllers\Admin\Authentication;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\VerifiedEmailService;
use Illuminate\Http\Request;

class VerifiedEmailController extends Controller
{
    public function sendLinkToMail(Request $request, User $user)
    {
        $verifiedService = app(VerifiedEmailService::class);
        $verified = $verifiedService->send($user);

        if (!$verified) {
            return redirect()
                ->route('admin.user.show', $user)
                ->with('error', "Sorry this email was verified!");
        }

        return redirect()
            ->route('admin.user.show', $user)
            ->with('success', "A link will be sent to email {$user->email}");
    }
}
