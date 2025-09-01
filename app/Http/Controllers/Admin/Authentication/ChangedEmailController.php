<?php

namespace App\Http\Controllers\Admin\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Authentication\ChangeEmailRequest;
use App\Models\User;
use App\Services\VerifiedEmailService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ChangedEmailController extends Controller
{
    public function action(ChangeEmailRequest $request, User $user)
    {
        DB::beginTransaction();

        try {
            $user->email = $request->email;
            $user->email_verified_at = null;
            $user->save();

            DB::table('sessions')
                ->where('user_id', $user->id)
                ->delete();

            DB::commit();
        } catch (\Exception $e) {
            Log::error('Error: ' . $e->getMessage());

            DB::rollBack();

            return redirect()
                ->route('admin.user.show', $user)
                ->with('error', 'Sorry we got problem right now.');
        }

        $verifiedService = app(VerifiedEmailService::class);
        $verified = $verifiedService->send($user);

        if (!$verified) {
            return redirect()
                ->route('admin.user.show', $user)
                ->with('error', "Sorry this email was verified!");
        }

        return redirect()
            ->route('admin.user.show', $user)
            ->with('success', 'Successfully change email to ' . $request->email);
    }
}
