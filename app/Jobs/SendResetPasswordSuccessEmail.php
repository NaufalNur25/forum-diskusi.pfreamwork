<?php

namespace App\Jobs;

use App\Mail\PasswordResetSuccessMail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendResetPasswordSuccessEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;

    /**
     * Create a new job instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        Mail::to($this->user->email)->send(new PasswordResetSuccessMail($this->user));
    }

    public function failed(\Throwable $exception)
    {
        Log::error('Failed to send email', [
            'user_id' => $this->user->id,
            'error' => $exception->getMessage()
        ]);
    }
}
