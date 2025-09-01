<?php

namespace App\Http\Controllers\Admin\Authentication;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BannedController extends Controller
{
    public function action(Request $request, User $user)
    {
        DB::beginTransaction();

        try {
            $user->is_blocked = !$user->is_blocked;
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

        return redirect()
            ->route('admin.user.show', $user)
            ->with('success', 'Successfully ' . ($user->is_blocked ? 'Banned' : 'Unbanned') . ' User.');
    }
}
