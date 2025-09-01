<?php

namespace App\Jobs;

use App\Mail\LinkVerifiedMail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SendVerifiedEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $verifiedUrl;
    protected $expired;

    /**
     * Create a new job instance.
     */
    public function __construct(User $user, string $verifiedUrl, int $expired)
    {
        $this->user = $user;
        $this->verifiedUrl = $verifiedUrl;
        $this->expired = $expired;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        Mail::to($this->user->email)->send(new LinkVerifiedMail($this->user, $this->verifiedUrl, $this->expired));
    }

    public function failed(\Throwable $exception)
    {
        Log::error('Failed to send link verified email', [
            'user_id' => $this->user->id,
            'error' => $exception->getMessage()
        ]);
    }
}
